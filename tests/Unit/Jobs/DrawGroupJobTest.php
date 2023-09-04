<?php

namespace Tests\Unit\Jobs;

use App\Jobs\DrawGroupJob;
use App\Jobs\SendGroupSelectionNotificationsJob;
use App\Models\Group;
use App\Models\Member;
use App\Models\Selection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
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
        $group = Group::factory()->create([
            'drawn_at' => null
        ]);
        Member::factory(20)->create([
            'group_id' => $group->id
        ]);
        $this->assertNull($group->drawn_at);

        DrawGroupJob::dispatch($group);
        $group = $group->fresh();
        $this->assertNotNull($group->drawn_at);
    }

    /** @test */
    public function job_will_dispatch_notifications_job()
    {
        $group = Group::factory()->create([
            'drawn_at' => null
        ]);
        Member::factory(4)->create([
            'group_id' => $group->id
        ]);
        Bus::fake();
        $job = new DrawGroupJob($group);
        $job->handle();
        Bus::assertDispatched(SendGroupSelectionNotificationsJob::class);


    }
}
