@extends('layouts.app')

@section('content')
    <div class="container "><br><br>
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h1>Create a new message</h1>
                        <form action="{{ route('messages.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="col-12">
                                <!-- Subject Form Input -->
                                <div class="form-group">
                                    <label class="control-label">Subject</label>
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" value="{{ old('subject') }}"
                                        required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="control-label">Recipients</label>
                                    <select class="form-control" name="recipients[]" required>
                                        <option value="">Select Recipient</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Message Form Input -->
                                <div class="form-group">
                                    <label class="control-label">Message</label>
                                    <textarea name="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                                </div>


                                <!-- Submit Form Input -->

                            </div>
                            <br>
                            <div class="col-12 text-end ">
                                <button type="submit" class="btn btn-primary ">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
