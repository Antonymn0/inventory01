{{-- checks for errors & messages outputs them to the screen --}}

{{-- 
@if($errors)
    @foreach ($errors->all() as $error)
    <div class=" alert alert-danger container col-md-9">
        {{$error}}

    </div>
    @endforeach
@endif 
--}}

@if(session('success'))
    <div class="alert alert-success container col-md-9">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger container col-md-9 mx-auto">
        {{session('error')}}
    </div>
@endif