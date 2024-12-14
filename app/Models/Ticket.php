<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_agent_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'ticket_categories');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'ticket_labels');
    }
}
