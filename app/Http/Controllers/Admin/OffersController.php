<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Offer;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 1;
        $page_size = 15;
        $offers = new Offer;
        if($request->has('title') && strlen($request->get('title')) > 0) {
            $offers = $offers->where('title', 'like', '%' . $request->get('title') . '%');
        }

        if($request->has('link_url') && strlen($request->get('link_url')) > 0) {
            $offers = $offers->where('link_url', 'like', '%' . $request->get('link_url') . '%');
        }
        $offers = $offers->paginate($page_size);
        return view('admin.offers.index', [
            'page' => $page,
            'page_size' => $page_size,
            'offers' => $offers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offers.create');
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
            'background_image' => 'required',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'required|date|after:start_date'
        ]);

        $input = $request->all();

        if ($request->hasFile('background_image')) {
            $background_image = $request->file('background_image');
            $filename = "Offers_banner_" . str_random(5) . "." . $background_image->getClientOriginalExtension();
            $background_image->move(public_path() . '/storage/', $filename);
            $input['image_url'] = $request->root() . '/storage/' . $filename;
        }
        $input['status'] = 'ACTIVE';
        // dd($input);
        $offer = Offer::create($input);

        return redirect('/admin/offers');
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
        $offer = Offer::find($id);
        return view('admin.offers.edit',[ 'offer' => $offer ]);
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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        $input = $request->all();

        if ($request->hasFile('background_image')) {
            $background_image = $request->file('background_image');
            $filename = "Offers_banner_" . str_random(5) . "." . $background_image->getClientOriginalExtension();
            $background_image->move(public_path() . '/storage/', $filename);
            $input['image_url'] = $request->root() . '/storage/' . $filename;
        }
        
        $offer = Offer::find($id)->update($input);
        return redirect('/admin/offers');
    }

    /**
     * Regain the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        $offer = Offer::find($id);
        $offer->update(['status' => 'ACTIVE']);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::find($id);
        $offer->update(['status' => 'INACTIVE']);

        return back();
    }
}
