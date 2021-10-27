<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exception extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'group_id',
        'member_id',
        'exception_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function groupMember()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exceptionMember()
    {
        return $this->belongsTo(Member::class, 'exception_id');
    }
}
