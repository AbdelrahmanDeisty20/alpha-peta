<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function ordeService(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $verificationCode = rand(1000, 9999);


        // إرجاع الكود الجديد كرد JSON
        return view('web.orderservice', compact('service'));
    }
    public function aboutService($id)
    {
        $service = Service::with(['media' => function ($query) {
            $query->take(3);
        }])->findOrFail($id);
        $otherServices = Service::where('id', '!=', $service->id)->inRandomOrder()->limit(5)->get();
        //  ?dd($otherServices);
        return view('web.aboutservice', compact('service', 'otherServices'));
    }
    public function service()
    {
        $services = Service::take(6)->get();
        return view('web.service', compact('services'));
    }
}
