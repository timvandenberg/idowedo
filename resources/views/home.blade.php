@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p style="float: left">You are logged in!</p>

                    <a href="/challenges/create" class="btn btn-dark" style="float: right">Create challege</a>

                    <a href="/friends/add" class="btn btn-info" style="float: right; clear: both">Manage friends</a>
                </div>

                <div class="card-body bg-red">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($challenges as $challenge)
                            <tr>
                                <td><a href="/challenges/{{$challenge->id}}">{{ $challenge->name }}</a></td>
                                <td>{{ $challenge->description }}</td>
                                <td>{{ $challenge->duration }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if(isset($challengeRequests) && !empty($challengeRequests))
            <div class="card">
                <div class="card-header">Challenge requests</div>
                <div class="card-body">

                    @foreach($challengeRequests as $challengeRequest)
                    <a href="/challenges/accept/{{$challengeRequest->id}}" class="btn btn-success"> accept {{$challengeRequest->name}}</a>
                    @endforeach

                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
