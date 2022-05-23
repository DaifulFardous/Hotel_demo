<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FoodOrder;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Product::all();
        return view('room.list', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $imageName = time().'.'. $request->image->extension();
        $imageUrl = $request->image->move(public_path('product'), $imageName);

        $room = new Product();
        $room->title = $request->title;
        $room->price = $request->price;
        $room->room_type = $request->room_type;
        $room->description = $request->description;
        $room->image = url('product/'.$imageName);
        $room->save();
        return redirect()->back()->with('success', 'Room has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Product::find($id);
        return view('room.edit', ['room'=>$room]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request)
    {
       $room = Product::find($request->id);
       //dd($room);
        $old_image = $room->image;
        if ($request->hasFile('image')) {
            if ($old_image) {
                file_exists(public_path('/product/').$old_image);
            }

            $imageName = time().'.'. $request->image->extension();
            $imageUrl = $request->image->move(public_path('product'), $imageName);
            $room->image = $imageName;
        }
        $room->title = $request->title;
        $room->price = $request->price;
        $room->room_type = $request->room_type;
        $room->description = $request->description;
        $room->update();
        return redirect('/food/list')->with('success', 'Room has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->forceDelete();
        return redirect()->back()->with('error', 'Room has been deleted.');
    }

    public function bookingList()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('booking.index', compact('bookings'));
    }

    public function foodOrderList()
    {
        $foodOrder = FoodOrder::orderBy('created_at', 'desc')->get();
        return view('booking.food-order', compact('foodOrder'));
    }
    public function release($id){
        $product = Product::find($id);
        if ($product->is_book == 1){
            $product->is_book = 0;
            $product->update();
            return redirect()->back()->with('error', 'Room has been released.');
        }else{
            return redirect()->back()->with('error', 'Room is already empty.');
        }

    }
}
