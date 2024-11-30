<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'group_id',
        'role'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Group()
    {
        return $this->belongsTo(Group::class);
    }
}