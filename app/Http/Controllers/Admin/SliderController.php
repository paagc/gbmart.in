<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\HomeSlide;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 1;
        $page_size = 15;
        $slides = new HomeSlide;
        $slides = $slides->paginate($page_size);
        return view('admin.home_slides.index', [
            'page' => $page,
            'page_size' => $page_size,
            'slides' => $slides
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home_slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'link_url' => 'required',
            'background_image' => 'required'
        ]);

        $input = $request->all();

        if ($request->hasFile('background_image')) {
            $background_image = $request->file('background_image');
            $filename = "Home_slides_" . str_random(5) . "." . $background_image->getClientOriginalExtension();
            $background_image->move(public_path() . '/storage/', $filename);
            $input['image_url'] = $request->root() . '/storage/' . $filename;
        }
        $input['status'] = 'ACTIVE';
        $home_slide = HomeSlide::create($input);
        return redirect('/admin/home-slide');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = HomeSlide::find($id);
        return view('admin.home_slides.edit', [ 'slide' => $slide ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'link_url' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('background_image')) {
            $background_image = $request->file('background_image');
            $filename = "Home_slides_" . str_random(5) . "." . $background_image->getClientOriginalExtension();
            $background_image->move(public_path() . '/storage/', $filename);
            $input['image_url'] = $request->root() . '/storage/' . $filename;
        }
        
        $home_slide = HomeSlide::find($id)->update($input);
        return redirect('/admin/home-slide');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $home_slide = HomeSlide::find($id);
        $home_slide->update(['status' => 'INACTIVE']);

        return back();
    }

    /**
     * Regain the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        $home_slide = HomeSlide::find($id);
        $home_slide->update(['status' => 'ACTIVE']);

        return back();
    }
}
