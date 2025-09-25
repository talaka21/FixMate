<?php

namespace App\Http\Controllers;

use App\Enum\ContactStatuEnum;
use App\Http\Requests\ContactRequestStore;
use App\Models\ContactRequest;
use App\Services\ContactRequestService;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
        private ContactRequestService $contactRequestService;

    // Laravel automatically injects ContactRequestService (Dependency Injection)
    public function __construct(ContactRequestService $contactRequestService)
    {
        $this->contactRequestService = $contactRequestService;
    }

 public function create()
    {
        return view('contact.create');
    }

  public function store(ContactRequestStore $request)
    {
        $data = $request->validated();

        $this->contactRequestService->store($data);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

}
