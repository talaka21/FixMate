<?php

namespace App\Models;

use App\Enum\NotificationEnum;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  protected $fillable = [
        'title',
        'message',
        'target_type',
        'target_id',
        'is_read',
        'send_at',
        'created_by',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'send_at' => 'datetime',
        'target_type'=>  NotificationEnum::class
    ];
public function target()
{
    return $this->morphTo();
}

}
