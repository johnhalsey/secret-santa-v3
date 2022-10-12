<?php

namespace Tests\Unit\Jobs;

use App\Jobs\DrawGroupJob;
use App\Models\Group;
use App\Models\Member;
use App\Models\Selection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DrawGroupJobTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function job_will_not_choose_self_as_member()
    {
        $group = Group::factory()->create();
        Member::factory(20)->create([
            'group_id' => $group->id
        ]);
        $this->assertCount(0, Selection::all());

        DrawGroupJob::dispatch($group);
        $this->assertCount(20, Selection::all());
        Selection::each(function ($selection) {
            $this->assertTrue($selection->santa_id != $selection->member_id);
        });
    }

    /** @test */
    public function job_will_mark_group_as_drawn()
    {
        //
    }

    /** @test */
    public function job_will_dispatch_notifications_job()
    {
        //
    }
}
