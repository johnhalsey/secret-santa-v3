<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class GroupMemberController extends Controller
{
    /**
     * @param Request $request
     * @param Group $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Group $group)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            $user = User::create([
                'name'     => $request->get('name'),
                'email'    => $request->get('email'),
                'password' => bcrypt(Str::random(8))
            ]);
        }

        if (!$user->groups->contains($group->id)) {
            Member::create([
                'user_id'  => $user->id,
                'group_id' => $group->id
            ]);
        }

        return Redirect::route('group.show', ['group' => $group->id]);
    }

    /**
     * @param Group $group
     * @param Member $member
     */
    public function destroy(Group $group, Member $member)
    {
        $member->delete();

        return response('Member Destroyed');
    }
}
