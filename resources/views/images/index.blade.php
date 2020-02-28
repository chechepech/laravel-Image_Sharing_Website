@extends('layouts.app')
@section('title','All images')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<h2 class="text-center">Your Awesome Image Sharing Website</h2>
	<a class="btn btn-primary btn-sm float-right" href="{{route('photos.create')}}" title="">NEW</a>
			<table class="table table-hover">
				<caption>List of images</caption>
				<thead class="thead-dark">
					<tr>
						<th>#</th>
						<th>Name</th>
						<th colspan="2" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
				@forelse($photos as $photo)
					<tr>
						<td><p>{{$photo->id}}</p></td>
						<td><a class="btn btn-link" href="{{route('photos.show',$photo)}}" title="">{{$photo->name}}</a></td>
						<td><a class="btn btn-primary btn-sm float-right" href="{{route('photos.edit',$photo)}}">EDIT</a></td>
						<td><form class="form-inline" action="{{route('photos.destroy',$photo)}}" method="post" accept-charset="utf-8">@csrf @method('DELETE')<input type="submit" class="btn btn-secondary btn-sm" value="DELETE">
						</form></td>
					</tr>
				@empty
					<tr>
						<td colspan="4"><p class="h1 text-center">No images!</p></td>
					</tr>
				@endforelse
				</tbody>
			</table>
			{{$photos->links()}}		
		</div>
	</div>
</div>
@endsection