<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Selection extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'group_id',
        'santa_id',
        'member_id',
        'notified_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function santa()
    {
        return $this->belongsTo(Member::class, 'santa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     *
     */
    public function notified()
    {
        $this->update([
            'notified_at' => Carbon::now()
        ]);
    }
}
