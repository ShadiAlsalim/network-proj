<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_id',
        'description'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function GroupMember()
    {
        return $this->hasMany(GroupMember::class);
    }
}