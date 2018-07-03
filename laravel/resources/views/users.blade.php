@extends('layouts.app')

@section('content')

@foreach($users as $user)
	{{$user->name}}
	{{$user->email}}
	@endforeach

@endsection