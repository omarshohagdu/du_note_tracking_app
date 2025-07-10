<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteTrackingMovement extends Model
{
    protected $table = 'note_tracking_movements';

    protected $fillable = [
        'note_meta_id',
        'note_action',
        'from_user',
        'to_user',
        'status',
        'message',
        'is_active',
        'created_by',
        'created_ip',
        'updated_by',
        'updated_ip',
    ];
}

