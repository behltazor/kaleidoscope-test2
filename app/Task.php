<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description'
    ];

    protected $hidden = [
        'completed', 'active'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
