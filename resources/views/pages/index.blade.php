@extends('layouts.app')

@section('content')
        <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>This is a mock-up site done with Laravel for the fictitious software company called CodeIQ</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>  <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
        </div>
@endsection
