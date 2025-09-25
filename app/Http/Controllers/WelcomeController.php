<?php

namespace App\Http\Controllers;

use App\Services\WelcomeService;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    private WelcomeService $welcomeService;

    public function __construct(WelcomeService $welcomeService)
    {
        $this->welcomeService = $welcomeService;
    }

    public function index(Request $request)
    {
        $data = $this->welcomeService->getData($request->search);

        return view('welcome', $data);
    }
}
