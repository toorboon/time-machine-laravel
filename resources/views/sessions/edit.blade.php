@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Edit Time Schedule Session</h5>
                </div>

                <div class="card-body">
                	{{-- Hier dafür sorgen, dass die ID in der Action mit übergeben wird!!! --}}
					<form action="{{ action('TimetableController@update', $session->id) }}" method='POST'>
						{{-- {{action('TimetableController@update', $session->id) }} --}}
					@csrf
					@method('PUT')
					  	<div class="row">
						  <div class="form-group col-6">
							<label for="start_time" class="">Start Time</label>
						  	<input type="text" class="form-control js-datepicker" name="start_time" value="{{ $session->start_time }}">
						  </div>
						  <div class="form-group col-6">
							<label for="stop_time" class="">Stop Time</label>
						  	<input type="text" class="form-control js-datepicker" name="stop_time" value="{{ $session->stop_time }}">
						  </div>
						  <div class="form-group col-6">
							<label for="start_pause" class="">Start Pause</label>
						  	<input type="text" class="form-control js-datepicker" name="start_pause" value="{{ $session->start_pause }}">
						  </div>
						  <div class="form-group col-6">
							<label for="stop_pause" class="">Stop Pause</label>
						  	<input type="text" class="form-control js-datepicker" name="stop_pause" value="{{ $session->stop_pause }}">
						  </div>
						  {{-- Think about how to fix that duration issue. You want the user to enter the pause duration? Or do you want the user to enter start and stop and the rest is calculated, or do you want both? --}}
						  <div class="form-group col-8">
							<label for="duration_pause" class="">Pause Duration</label>
						  	<input type="number" class="form-control" name="duration_pause" placeholder="Pause in minutes!" value="{{ $session->duration_pause }}">
						  </div>
						  <div class="form-group col-12">
							<label for="notes" class="">Notes</label>
						  	<input type="text" class="form-control" name="notes" placeholder="Put some notes here!" value="{{ $session->notes }}">
						  </div>
						</div>
						  <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary">Back</a>
						  <input class="btn btn-sm btn-success" type="submit" value="Edit">
						  
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection