@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Show Session</h5>
                </div>
{{-- {{ dd($session) }} --}}

                <div class="card-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Column</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td>Start Time</td>
								<td>{{ \Carbon\Carbon::parse($session->start_time)->format('d.m.y H:i')}}</td>
							</tr>
							<tr>
								<td>Stop Time</td>
								<td>{{ $session->stop_time != null ? \Carbon\Carbon::parse($session->stop_time)->format('d.m.y H:i') : '-'}}</td>
							</tr>
							<tr>
								<td>Start Pause</td>
								<td>{{ $session->start_pause != null ? \Carbon\Carbon::parse($session->start_pause)->format('d.m.y H:i') : '-'}}</td>
							</tr>
							<tr>
								<td>Stop Pause</td>
								<td>{{ $session->stop_pause != null ? \Carbon\Carbon::parse($session->stop_pause)->format('d.m.y H:i') : '-' }}</td>
							</tr>
							<tr>
								<td>Duration Pause</td>
								<td>{{$session->duration_pause/1000}} minutes</td>
							</tr>
							<tr>
								<td>Notes</td>
								<td>{{$session->notes}}</td>
							</tr>
						</tbody>
					</table>
					<hr>
					<small>Inserted on {{$session->created_at}}</small>
					<hr>
					<div class="d-flex justify-content-between">
						<a href="{{route('dashboard')}}" class="btn btn-sm btn-secondary">Go Back</a>
						<div class="btn-group">
							<a href='{{route('sessions.edit',$session->id)}}' class="btn btn-sm btn-success">Edit</a>
							<form action="{{ action('TimetableController@destroy', $session->id) }}" method="POST">
	                            @csrf
	                            @method('DELETE')
	                            <input class="btn btn-sm btn-danger" type="submit" value="Delete">
	                        </form>
	                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
