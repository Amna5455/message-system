@extends('layouts.app')

@section('content')
<div class="container "><br><br>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card overflow-y-scroll" style="height: 450px">
                <div class="card-body">
                    {{--  <h1>{{ $thread->subject }}</h1>  --}}
                    @each('messenger.partials.messages', $thread->messages, 'message')

                    @include('messenger.partials.form-message')
                </div>
            </div>
        </div>
    </div>
</div>

@stop
