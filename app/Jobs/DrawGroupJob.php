<?php

namespace App\Jobs;

use App\Models\Group;
use App\Models\Selection;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DrawGroupJob
{
    use Dispatchable, SerializesModels;

    /**
     * @var Group
     */
    private $group;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->group->members()
            ->withCount('exceptions')
            ->orderBy('exceptions_count', 'desc')
            ->each(function ($member) {
                $exceptions = $member->exceptions->pluck('exception_id')->toArray();
                $exceptions[] = $member->id; // cant choose yourself
                $selectedUser = $this->group->members()
                    ->whereNotIn('id', $exceptions)
                    ->where('drawn', 0)
                    ->orderByRaw("RAND()")
                    ->first();

                $selectedUser->drawn = 1;
                $selectedUser->save();

                Selection::create([
                    'group_id'  => $this->group->id,
                    'santa_id'  => $member->id,
                    'member_id' => $selectedUser->id
                ]);
            });

        $this->group->update([
            'drawn_at' => Carbon::now()
        ]);

        SendGroupSelectionNotificationsJob::dispatch($this->group);
    }
}
