@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Create Time Schedule Session</h5>
                </div>

                <div class="card-body">
					<form action="{{ action('TimetableController@store')}}" method='POST'>
					@csrf
					  <div class="row">
						  <div class="form-group col-6">
							<label for="start_time" class="">Start Time</label>
						  	<input type="datetime" class="form-control js-datepicker" name="start_time" value="{{ \Carbon\Carbon::now() }}">
						  </div>
						  <div class="form-group col-6">
							<label for="stop_time" class="">Stop Time</label>
						  	<input type="text" class="form-control js-datepicker" name="stop_time" value="{{ \Carbon\Carbon::now() }}">
						  </div>
						  <div class="form-group col-6">
							<label for="start_pause" class="">Start Pause</label>
						  	<input type="text" class="form-control js-datepicker" name="start_pause" >
						  </div>
						  <div class="form-group col-6">
							<label for="stop_pause" class="">Stop Pause</label>
						  	<input type="text" class="form-control js-datepicker" name="stop_pause">
						  </div>
						  <div class="form-group col-8">
							<label for="duration_pause" class="">Pause Duration</label>
						  	<input type="number" class="form-control" name="duration_pause" placeholder="Pause in minutes!">
						  </div>
						  <div class="form-group col-12">
							<label for="notes" class="">Notes</label>
						  	<input type="text" class="form-control" name="notes" placeholder="Put some notes here!">
						  </div>
						</div>
						  <a href="{{route('dashboard')}}" class="btn btn-sm btn-danger">Back</a>
						  <input class="btn btn-sm btn-primary" type="submit" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
