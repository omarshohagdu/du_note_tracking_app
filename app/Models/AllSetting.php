<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllSetting extends Model
{
//    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'display_order',
        'is_active',
    ];
}
