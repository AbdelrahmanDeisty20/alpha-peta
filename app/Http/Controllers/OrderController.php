<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderService;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{



    public function store(OrderService $request)
    {

        $order = Order::create($request->validated());

        if (request()->ajax()) {
            return response()->json([
                'message' => __('تم طلب الخدمة بنجاح')
            ]);
    }

        return redirect()->back()->with('success', __('تم طلب الخدمة بنجاح'));
    }

    public function orderService($id)
    {
        $orders = Service::findOrFail($id);
        return view('web.orderservice',compact('orders'));
    }

}
