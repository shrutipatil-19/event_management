<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Event\Event;

class Category extends Model
{
    protected $fillable = [
        'category_name',
        'description',
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
