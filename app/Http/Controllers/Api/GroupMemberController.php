<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GroupMemberController extends Controller
{
    public function store(Request $request, Group $group)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email')
            ]);
        }

        if (!$user->groups->contains($group->id)) {
            Member::create([
                'user_id' =>  $user->id,
                'group_id' => $group->id
            ]);
        }

        return Redirect::route('group.show', ['group' => $group->id]);
    }
}
