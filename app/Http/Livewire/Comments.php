<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{
    // use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $author, $comment, $image;
    // public $comments;

    protected $rules = [
        'comment' => 'required|min:6'
    ];

    protected $listeners = ['fileUpload' => 'handleFileUpload'];

    public function handleFileUpload($image)
    {
        $this->image = $image;
    }

    public function addComment()
    {
        $this->validate();

        $commentOBJ = new Comment;
        $commentOBJ = $commentOBJ->saveNewComment($commentOBJ, $this->comment);
        session()->flash('message', 'Comment successfully created.');
        // $this->comments->prepend($commentOBJ);
        $this->comment = null;
    }

    public function delete($id)
    {
        Comment::find($id)->delete();
        session()->flash('message', 'Comment successfully deleted.');
        // $this->comments = $this->comments->except($id);
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::with('user')->latest()->paginate(2)
        ]);
    }
}
