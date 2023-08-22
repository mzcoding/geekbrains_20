<br>
<h2>Добро пожаловать, {{ Auth::user()->name }}</h2>
<br>
@if(Auth::user()->is_admin === true)
    <a href="{{ route('admin.index') }}">В админку</a>
@endif
