<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Booking;
use App\Models\Food;
use App\Models\FoodOrder;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class FrontendController extends Controller
{
    public function index()
    {
        $data = [
            'rooms' => Product::orderBy('created_at', 'desc')->get(),
            'foods' => Food::orderBy('created_at', 'desc')->get(),
            'address' => Address::first(),
        ];
        return view('frontend.index', compact('data'));
    }

    public function details($id)
    {
        $room = Product::orderBy('created_at', 'desc')->find($id);
        return view('frontend.details', compact('room'));
    }

    public function booking(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:bookings,email',
            'phone' => 'required|unique:bookings,phone',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        try {
            $booking = new Booking();
            $booking->name = $request->name;
            $booking->phone = $request->phone;
            $booking->email = $request->email;
            $booking->start_date = $request->start_date;
            $booking->end_date = $request->end_date;
            $booking->price = $request->price;
            $room = Product::find($request->id);
            if($room->is_book == 1){
                return redirect()->back()->with('success', 'The room is already booked');
            }else{
                $room->is_book = 1;
                $room->update();
                $booking->save();
                return redirect()->back()->with('success', 'Your room has been booked.');
            }
        }catch (Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function foodDetails($id)
    {
        $food = Food::find($id);
        return view('frontend.food-details', compact('food'));
    }

    public function foodOrder(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:food_orders,email',
            'phone' => 'required|unique:food_orders,phone',
            'payment_method' => 'required',
        ]);
        try {
            $foodOrder = new FoodOrder();
            $foodOrder->name = $request->name;
            $foodOrder->phone = $request->phone;
            $foodOrder->email = $request->email;
            $foodOrder->payment_method = $request->payment_method;
            $foodOrder->price = $request->price;
            $foodOrder->save();
            return redirect()->back()->with('success', 'Your food has been ordered.');
        }catch (Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
