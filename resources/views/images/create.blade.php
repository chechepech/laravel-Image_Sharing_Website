@extends('layouts.app')
@section('title','New image')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">
				<form class="bg-white py-3 px-4 shadow rounded" action="{{route('photos.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<h2 class="text-center">NEW IMAGE</h2>
					<hr>
					@csrf
					<div class="form-group">
						<label for="photo">Name</label>
						<input class="form-control" type="text" id="photo" name="name" value="{{old('name')}}" required autofocus placeholder="Enter a name for image">
					</div>
					<div class="input-group">  
					    <div class="custom-file">
						<input type="file" class="custom-file-input" name="image" id="CustomFile" value="{{old('image')}}" accept="image/*">
					      <label class="custom-file-label" for="CustomFile">Choose a image</label>
					    </div>
				  	</div>
				  	<br/>
					<input type="submit" class="btn btn-primary btn-sm" value="Save">
					<a class="btn bnt-secondary btn-sm" href="{{url('/')}}" title="">Back</a>
				</form>
			</div>
		</div>
	</div>
@endsection