<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteTrackingContent extends Model
{
    protected $table = 'note_tracking_contents';

    protected $fillable = [
        'note_meta_id',
        'note_body',
        'is_active',
        'created_by',
        'created_ip',
        'updated_by',
        'updated_ip',
    ];
}
