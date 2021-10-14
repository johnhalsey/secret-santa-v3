<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Groups', [
            'groups' => $request->user()->groups
        ]);
    }

    public function show(Request $request, Group $group)
    {
        return Inertia::render('Groups/ShowGroupPage', [
            'group' => new GroupResource($group),
        ]);
    }
}
