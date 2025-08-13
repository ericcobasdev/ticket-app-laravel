<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Ticket extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'priority', 'status', 'user_id', 'assigned_to',
    ];

    public function assignedTechnician()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}

