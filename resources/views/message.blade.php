@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mg-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
<div class="alert alert-success alert-dismissable fade show" role="alert">{{session('success')}}<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger">
        {{session('error')}}
</div>
@endif