<?php

namespace App\Http\Controllers;

use App\Enum\ContactStatuEnum;
use App\Http\Requests\ContactRequestStore;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
 public function create()
    {
        return view('contact.create');
    }

    public function store(ContactRequestStore $request)
    {
        $data = $request->validated();

        ContactRequest::create([
            'user_name'    => $data['user_name'],
            'phone_number' => $data['phone_number'],
            'message'      => $data['message'],
            'status'       => ContactStatuEnum::UNREAD,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

}
