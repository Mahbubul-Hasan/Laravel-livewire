<div>
    <h2 class='text-center'>Support Tickets</h2>
    @foreach ($tickets as $ticket)
    <div class="card mt-1">
        <div class="card-body {{ $active == $ticket->id ? 'bg-primary': '' }}" wire:click="$emit('selectedTicketID', {{ $ticket->id }})" role="button">
            <p class="card-text">{{ $ticket->question }}</p>
        </div>
    </div>
    @endforeach
</div>
