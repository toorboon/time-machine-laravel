@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Your Timetable</h5>
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="sessions/create" class="btn btn-info mb-3">Create New</a>

                    @if($sessions)
                    <table class="table table-hover">
                        <tr>
                            <th>Start</th>
                            <th>End</th>
                            <th></th>
                        </tr>
                        @foreach($sessions as $session)

                            <tr data-href="{{route('sessions.show',$session->id)}}">

                                <td>{{ \Carbon\Carbon::parse($session->start_time)->format('d.m.Y H:i') }}</td>
                                <td>{{ $session->stop_time != null ? \Carbon\Carbon::parse($session->stop_time)->format('d.m. H:i') : 'Open!' }}
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('sessions.edit',$session->id)}}" class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ action('TimetableController@destroy', $session->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                                        </form>
                                    </div>
                                </td>

                            </tr>

                        @endforeach

                    </table>
                    {{ $sessions->links() }}
                    @else
                        <p class="text-center">No sessions are saved yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
