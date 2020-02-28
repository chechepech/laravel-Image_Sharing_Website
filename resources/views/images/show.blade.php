@extends('layouts.app')
@section('title','Show image')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">
				<div class="card bg-white mb-3 shadow rounded">			
					<div class="card-header">
						IMAGE
					</div>
					<img class="card-img-top" src="{{asset('uploads').'/'.$photo->image}}" alt="{{$photo->name}}">
					<div class="card-body">
						<h5 class="card-title">{{$photo->name}}</h5>
						<p class="card-text">
							Direct Image URL
						<input type="text" class="form-control" onclick="this.select();" readonly value="{{url(asset('uploads').'/'.$photo->image)}}"></p>			
						<p class="card-text">
							Thumbnail Forum BBCode
						<input type="text" class="form-control" onclick="this.select();" readonly value="[url={{Request::url()}}][img]{{URL::to(asset('uploads').'/'.$photo->image)}}[/img][/url]"></p>	
						<p class="card-text">
							Thumbnail HTML Code
						<input type="text" class="form-control" onclick="this.select();" readonly value="<a href=&quot;{{Request::url()}}&quot;><img src=&quot;{{url(asset('uploads').'/'.$photo->image)}}&quot; alt=&quot;{{$photo->name}}&quot;></a>"></p>
					<a href="{{route('photos.index')}}" class="btn btn-secondary btn-sm">Back</a>
					</div>
					<div class="card-footer">
      					<small class="text-muted">Created at:&ensp;{{$photo->created_at->diffForHumans()}}</small>
    				</div>
				</div>
			</div>
		</div>
	</div>
@endsection