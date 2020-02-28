@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<div class="row py-3">				
				<!-- this row should be used within a container -->
				@if(count($photos))
					@foreach($photos as $photo)
				<div class="col-lg-4 col-sm-6 mx-auto py-3">
					<!-- card -->
					<div class="card bg-white mb-3 shadow rounded h-100">
						<div class="card-header">#{{$photo->id}}</div>
						<img class="card-img-top" src="{{asset('uploads').'/'.$photo->image}}" alt="{{$photo->name}}">
						<div class="card-body">
							<h5 class="card-title">IMAGE</h5>
							<p class="card-text">{{$photo->name}}</p>
						<a class="btn btn-secondary btn-sm float-left" href="{{route('photos.show',$photo)}}">Links</a>					
						</div>
						<div class="card-footer">
      						<small class="text-muted">Created at:&ensp;{{$photo->created_at->diffForHumans()}}</small>
    					</div>
					</div>
					<!-- card -->
				</div>
				@endforeach
				@else
					<p>No images uploaded yet!</p>
				@endif
				{{$photos->links()}}	
			</div>
		</div>
	</div>
</div>
@endsection