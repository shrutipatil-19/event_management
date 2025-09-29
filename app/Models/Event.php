<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'publish_at', 'status', 'img'];

    protected $dates = ['publish_at', 'created_at', 'updated_at'];

    protected $casts = [
        'img' => 'array',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopePublished($query)
    {
        return $query->where('publish_at', '<=', now('UTC'))
            ->where('status', 'published')
            ->whereNull('deleted_at');
    }
}
