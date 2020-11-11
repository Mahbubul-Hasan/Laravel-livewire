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

    public function saveNewComment($commentOBJ, $comment, $image)
    {
        $commentOBJ->comment = $comment;
        $commentOBJ->user_id = 1;
        $commentOBJ->image = $image;

        $commentOBJ->save();

        return $commentOBJ;
    }
}
