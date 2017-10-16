
@if (Auth::user()->is_favorite($micropost->id))
    {!! Form::open(['route' => ['micropost.unfavorite', $micropost->id], 'method' => 'delete']) !!}
        {!! Form::submit('　★　', ['class' => "btn btn-warning btn-xs"])!!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['micropost.favorite', $micropost->id]]) !!}
        {!! Form::submit('　☆　', ['class' => "btn btn-warning btn-xs"])!!}
    {!! Form::close() !!}
@endif