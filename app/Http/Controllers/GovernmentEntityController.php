<?php

namespace App\Http\Controllers;

use App\Models\GovernmentEntity;
use Illuminate\Http\Request;

class GovernmentEntityController extends Controller
{
     public function index(Request $request)
    {
     $query = GovernmentEntity::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $entities = $query->paginate(10);

    return view('government_entities.index', compact('entities'));
    }
}
