<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'badge_text',
        'image',
        'btn_link',
        'order_num',
        'status',
    ];
}
