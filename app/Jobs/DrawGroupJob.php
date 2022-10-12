<?php

namespace App\Jobs;

use App\Models\Group;
use App\Models\Selection;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DrawGroupJob
{
    use Dispatchable, SerializesModels;

    protected $tries = 3;

    protected $tried = 0;

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
        try {
            $this->group->members()
                ->withCount('exceptions')
                ->orderBy('exceptions_count', 'desc')
                ->each(function ($member) {
                    $exceptions = $member->exceptions->pluck('exception_id')->toArray();
                    Log::info($exceptions);
                    $exceptions[] = $member->id; // cant choose yourself
                    Log::info($exceptions);
                    $selectedUser = $this->group->members()
                        ->whereNotIn('id', $exceptions)
                        ->where('drawn', 0)
                        ->inRandomOrder()
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
        } catch (\Exception $exception) {
            $this->tried++;
            Log::info('tried ' . $this->tried);
            if ($this->tried < $this->tries) {
                $this->group->resetSelections();
                $this->handle();
            }
            throw new \Exception('Could not draw group');
        }
    }
}
