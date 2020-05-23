@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('All users') }}</div>

                <div class="card-body">
                    @if(isset($allUsers))
                    @foreach($allUsers as $user)
                    <a href="/friends/add/{{$user->id}}" class="btn btn-info">Add {{ $user->name}}</a>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Friend requests') }}</div>

                <div class="card-body">
                    @if(isset($friendRequests))
                    @foreach($friendRequests as $id => $friendRequest)
                    <a href="/friends/accept/{{$id}}" class="btn btn-info">Accept {{ $friendRequest }}</a>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Friends') }}</div>

                <div class="card-body">
                    @if(isset($friends))
                    @foreach($friends as $id => $friend)
                    <a href="/" class="btn btn-success">{{ $friend->name }}</a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
