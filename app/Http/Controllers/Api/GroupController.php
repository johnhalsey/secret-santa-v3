<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\DrawGroupJob;
use App\Models\Group;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GroupController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $group = Group::create([
            'name' => $request->input('name'),
            'organiser_id' => $request->user()->id
        ]);

        Member::create([
            'user_id' =>  $user->id,
            'group_id' => $group->id
        ]);

        return Redirect::route('groups');
    }

    /**
     * @param Group $group
     */
    public function draw(Group $group)
    {
        $group->resetSelections();

        try{
            DrawGroupJob::dispatch($group);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }
}
