<?php

namespace App\Jobs;

use App\Models\Group;
use App\Notifications\GroupSelectionNotification;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendGroupSelectionNotificationsJob
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

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
        $this->group->selections->each(function($selection){
            $selection->santa->user->notify(new GroupSelectionNotification($selection));
            $selection->notified();
        });
    }
}
