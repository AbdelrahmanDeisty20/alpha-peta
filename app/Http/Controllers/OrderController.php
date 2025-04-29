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


        $order = Order::create(array_merge(
            $request->validated(),
            ['service_id' => $request->service_id]
        ));
        $order->load('service');



        $title = 'لقد طلب العميل ' . $request->name .
                 ' :خدمة ' . $order->service->title .
                 ' بخصوص: ' . ($request->subject ) .
                 ' - الإيميل: ' . $request->email .
                 ' - الهاتف: ' . $request->phone;
        sendNotifyAdmin($title, 'عرض الرساله', route('filament.admin.resources.orders.view', $order->id));

        return redirect()->back()->with('success', __('تم طلب الخدمة بنجاح'));
    }

    public function orderService($id)
    {
        $orders = Service::findOrFail($id);
        return view('web.orderservice', compact('orders'));
    }
}
