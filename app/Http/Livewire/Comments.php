<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Intervention\Image\Facades\Image;

use function PHPUnit\Framework\fileExists;

class Comments extends Component
{
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
        $image = $this->storeImage();

        $commentOBJ = new Comment;
        $commentOBJ = $commentOBJ->saveNewComment($commentOBJ, $this->comment, $image);
        session()->flash('message', 'Comment successfully created.');
        // $this->comments->prepend($commentOBJ);

        $this->comment = null;
        $this->image = null;
    }

    public function storeImage()
    {
        if (!$this->image) {
            return null;
        }

        $image = Image::make($this->image)->encode('jpg');

        $file_directory = 'asset/img/';
        $file_name = Carbon::now()->format('Ymd_Hms') . '.jpg';

        $image->save($file_directory . $file_name);

        return $file_directory . $file_name;
    }

    public function delete($id)
    {
        $commentOBJ = Comment::find($id);

        if (fileExists($commentOBJ->image)) {
            unlink($commentOBJ->image);
        }
        $commentOBJ->delete();
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
