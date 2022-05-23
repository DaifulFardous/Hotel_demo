<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $address = Address::first();
        return view('home', compact('address'));
    }

    public function address(Request $request)
    {
        $this->validate($request, [
            'address' => 'required|max:255'
        ]);
        if ($request->id){
            $address = Address::find($request->id);
            $address->address = $request->address;
            $address->save();
            return redirect()->back()->with('success', 'Address has been updated.');
        }else{
            $address = new Address();
            $address->address = $request->address;
            $address->save();
            return redirect()->back()->with('success', 'Address has been inserted.');
        }
    }
}
