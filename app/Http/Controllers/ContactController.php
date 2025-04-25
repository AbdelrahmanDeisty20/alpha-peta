<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $contact =  Contact::create($request->validated());
        if (request()->ajax()) {
            return response()->json([
                'message' => __('تم الإرسال بنجاح، سيتم التواصل معك قريباً')
            ]);
        }
        return redirect()->back()->with('success',__(' تم الارسال بنجاح وسيتم التواصل معك قريبا'));
    }
    public function contact()
    {
        return view('web.contact');
    }
}
