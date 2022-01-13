<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'session_id',
        'content',
        'votes',
        'criteria1',
        'criteria2'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
