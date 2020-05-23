@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Challenge') }}</div>

                <div class="card-body">
                    <h2>{{ $challenge->name }}</h2>
                    <p>Description: {{ $challenge->description }}</p>
                    <p>Duration: {{ $challenge->duration }} min</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Send Challenge to') }}</div>

                <div class="card-body">
                    @if(isset($friends))
                    @foreach($friends as $id => $friend)
                    <a href="/challenges/send/{{$friend->id}}/{{$challenge->id}}" class="btn btn-success">send to {{ $friend->name }}</a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
