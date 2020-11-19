<div>
    <h2 class='text-center'>Comments</h2>

    <form class='my-3' wire:submit.prevent='addComment'>
        <div>
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
        <div class="form-row">
            <div class="col-10">
                <input type="file" class="form-control-file" id="file-input" wire:change="$emit('fileChoosen')">
            </div>
            <div class="col-2 mb-3 px-0">
                <img src="{{ $image }}" alt="" class="img-fluid">
            </div>
            <div class="col-10 mt-2">
                <textarea class="form-control" placeholder="Enter your comment" wire:model.lazy='comment'></textarea>
                @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button class="col-2 btn btn-primary" >Comment</button>
        </div>
    </form>
    @foreach ($comments as $comment)
    <div class="card mt-1">
        <div class="card-body">
            <div class='d-flex justify-content-between'>
                <span class="card-title h5 font-weight-bold">{{ $comment->user->name }}</span>
                <span class=''>{{ $comment->created_at->diffForHumans() }}</span>
                <i class="fas fa-times text-danger" role="button" wire:click='delete({{ $comment->id }})'></i>
            </div>
            <img src="{{ $comment->image }}" alt="" class="img-fluid">
            <p class="card-text">{{ $comment->comment }}</p>
        </div>
    </div>
    @endforeach
    <div class="mt-5 d-flex justify-content-center">
        {{ $comments->links() }}
    </div>
</div>

<script>
    Livewire.on('fileChoosen', () => {
        let file = document.getElementById("file-input").files[0];
        let reader = new FileReader();

        reader.addEventListener("load", function () {
            Livewire.emit('fileUpload', reader.result)
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    })
</script>
