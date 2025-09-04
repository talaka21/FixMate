<?php

namespace App\Http\Controllers;

use App\Enum\ContactStatuEnum;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function create()
    {
        return view('contact.create'); // ملف Blade للصفحة
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name'    => 'required|string|max:255',
            'phone_number' => 'required|string|max:10',
            'message'      => 'required|string',
        ]);

        ContactRequest::create([
            'user_name'    => $request->user_name,
            'phone_number' => $request->phone_number,
            'message'      => $request->message,
               'status' => ContactStatuEnum::UNREAD,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
