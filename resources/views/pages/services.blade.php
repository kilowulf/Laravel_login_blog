@extends('layouts.app')

@section('content')
        <h1>{{$title}}</h1>
        @if(count($services) > 0)
                <ul class="list-group">
                        @foreach($services as $service)
                                <li class="list-group-item">{{$service}}</li>
                        @endforeach
                </ul>
        @endif
        <p><strong>CodeIQ provides our clientele with numerous client and server side services</strong></p>
@endsection