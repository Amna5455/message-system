{{--  <h2>Add a new message</h2>  --}}
<form action="{{ route('messages.update', $thread->id) }}" method="post">
    {{ method_field('put') }}
    {{ csrf_field() }}

    <!-- Message Form Input -->
    <div class="form-group">
        <textarea name="message" class="form-control" rows="5">{{ old('message') }}</textarea>
    </div><br>

    <!-- Submit Form Input -->
    <div class="form-group text-end">
        <button type="submit" class="btn btn-primary ">Submit</button>
    </div>
</form>
