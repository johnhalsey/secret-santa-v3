<?php

namespace App\Http\Controllers\Api;

use App\Models\Exception;
use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GroupExceptionController extends Controller
{
    /**
     * @param Request $request
     * @param Group $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Group $group)
    {
        Exception::firstOrCreate([
            'group_id' => $group->id,
            'member_id' => $request->input('user_a_id'),
            'exception_id' => $request->input('user_b_id')
        ]);

        return Redirect::route('group.show', [$group->id]);
    }
}
