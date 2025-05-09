@extends('layouts.app')

@section('content')
    @include('messenger.partials.flash')
    <div class="container  mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th scope="col"><a href="{{ url('messages/create') }}" class="btn btn-info">New
                                            Message</a></th>
                                    <th scope="col">Sender</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($threads as $thread)
                                    <?php $class = $thread->isUnread(Auth::id()) ? 'table-info' : ''; ?>
                                    <tr class="{{ $class }}">
                                        <th scope="row"></th>
                                        <td>{{ $thread->creator()->name }}<span class="badge bg-warning">
                                                ({{ $thread->userUnreadMessagesCount(Auth::id()) }} unread)</span></td>
                                        <td><a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a>
                                        </td>
                                        <td><a href="{{ route('messages.destroy', $thread) }}" class="btn btn-danger btn-sm">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
