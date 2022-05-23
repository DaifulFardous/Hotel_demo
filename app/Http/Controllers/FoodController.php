<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use Illuminate\Database\Eloquent\Model;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all();
        return view('food.list', compact('foods'));
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
     * @param  \App\Http\Requests\StoreFoodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFoodRequest $request)
    {
        $imageName = time().'.'. $request->image->extension();
        $imageUrl = $request->image->move(public_path('food'), $imageName);

        $food = new Food();
        $food->name = $request->name;
        $food->price = $request->price;
        $food->description = $request->description;
        $food->image = url('food/'.$imageName);
        $food->save();
        return redirect()->back()->with('success', 'Food has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::find($id);
        return view('food.edit', ['food'=>$food]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFoodRequest  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFoodRequest $request)
    {
        $food = Food::find($request->id);
        //dd($room);
        $old_image = $food->image;
        if ($request->hasFile('image')) {
            if ($old_image) {
                file_exists(public_path('/product/').$old_image);
            }

            $imageName = time().'.'. $request->image->extension();
            $imageUrl = $request->image->move(public_path('product'), $imageName);
            $food->image = $imageName;
        }
        $food->name = $request->name;
        $food->price = $request->price;
        $food->description = $request->description;
        $food->update();
        return redirect('/food/list')->with('success', 'Room has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->back()->with('error', 'Food has been deleted.');
    }
}
