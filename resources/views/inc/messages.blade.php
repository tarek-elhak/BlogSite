<!-- check for errors -->
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif
<!-- check for sesion success -->

@if (session ('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
@endif
<!-- check for session fails-->
@if (session ('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
@endif