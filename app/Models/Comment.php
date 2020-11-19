<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supportTicket()
    {
        return $this->belongsTo(SupportTicket::class);
    }

    public function saveNewComment($commentOBJ, $comment, $ticketId, $image)
    {
        $commentOBJ->comment = $comment;
        $commentOBJ->user_id = User::all()->random()->id;
        $commentOBJ->support_ticket_id = $ticketId;
        $commentOBJ->image = $image;

        $commentOBJ->save();

        return $commentOBJ;
    }
}
