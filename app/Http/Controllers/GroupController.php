<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GroupController extends Controller
{
    /**
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Groups', [
            'groups' => $request->user()->groups
        ]);
    }

    /**
     * @param Request $request
     * @param Group $group
     * @return \Inertia\Response
     */
    public function show(Request $request, Group $group)
    {
        return Inertia::render('Groups/ShowGroupPage', [
            'group' => new GroupResource($group),
        ]);
    }
}
