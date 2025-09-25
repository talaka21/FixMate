<?php

namespace App\Http\Controllers;

use App\Models\GovernmentEntity;
use App\Services\GovernmentEntityService;
use Illuminate\Http\Request;

class GovernmentEntityController extends Controller
{
    private GovernmentEntityService $governmentEntityService;

    public function __construct(GovernmentEntityService $governmentEntityService)
    {
        $this->governmentEntityService = $governmentEntityService;
    }

    public function index(Request $request)
    {
        $search = $request->get('search', null);
        $entities = $this->governmentEntityService->getEntities($search, 10);

        return view('government_entities.index', compact('entities'));
    }
}
