<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $contact =  Contact::create($request->validated());
        // $admin = User::where(column: 'is_admin', true)->first();

        $title = 'يريد العميل ' . $request->name . ' التواصل معك' . ' بخصوص ' . $request->subject . ' وهذا ايميله ' . $request->email;
        sendNotifyAdmin($title, 'عرض الرساله', route('filament.admin.resources.contacts.view', $contact->id));



        return redirect()->back()->with('success',__(' تم الارسال بنجاح وسيتم التواصل معك قريبا'));
    }
    public function contact()
    {
        return view('web.contact');
    }
}
