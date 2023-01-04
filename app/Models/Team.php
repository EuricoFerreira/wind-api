<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "owner_id"
    ];

    public function members()
    {
        return $this->belongsToMany(User::class, "team_has_members");
    }

    public function owner()
    {
        return $this->belongsTo(User::class, "owner_id", "id");
    }
}
