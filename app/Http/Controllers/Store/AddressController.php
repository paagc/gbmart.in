<?php

namespace App\Http\Controllers\Store;

use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function update(Request $request, $id)
    {
        Address::find($id)->update($request->all());

        return back();
    }

    public function delete($id)
    {
        Address::destroy($id);
        return back();
    }

    public function setActive($id)
    {
        auth()->addresses()->update(['status' => 'INACTIVE']);
        auth()->addresses()->where('id', $id)->update(['status' => 'ACTIVE']);
        return back();
    }

}

