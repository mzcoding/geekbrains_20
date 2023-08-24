<br>
<h2>Добро пожаловать, {{ Auth::user()->name }}</h2>
<br>
@if(Auth::user()->is_admin === true)
    <a href="{{ route('admin.index') }}">В админку</a>
@endif

@if(Auth::user()->avatar !== null)
    <img src="{{ Auth::user()->avatar }}" style="width:250px;">
@endif
