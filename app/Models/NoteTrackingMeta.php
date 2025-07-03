<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteTrackingMeta extends Model
{
    protected $table = 'note_tracking_metas';

    protected $fillable = [
        'title',
        'reference_no',
        'current_status',
        'is_active',
        'created_by',
        'created_ip',
        'updated_by',
        'updated_ip',
    ];
}
