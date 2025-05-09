<p class="border rounded p-2 @if(Auth::user()->id == $message->user->id) bg-info text-white @else text-end @endif">{{ $message->body }}
    <span class="text-muted d-block">
        <small>{{ $message->user->name }} <span class="badge bg-light text-muted">({{ $message->created_at->diffForHumans() }})</span></small>
    </span>

</p>
