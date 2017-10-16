@extends('layouts.app')

@section('content')
    @include('microposts.microposts', ['microposts' => $microposts])
@endsection