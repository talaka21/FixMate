<?php

namespace App\Services;

use App\Enum\ContactStatuEnum;
use App\Models\ContactRequest;

class ContactRequestService
{
    /**
     * Store a new contact request
     */
    public function store(array $data): ContactRequest
    {
        return ContactRequest::create([
            'user_name'    => $data['user_name'],
            'phone_number' => $data['phone_number'],
            'message'      => $data['message'],
            'status'       => ContactStatuEnum::UNREAD,
        ]);
    }
}
