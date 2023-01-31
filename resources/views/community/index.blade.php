@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-2">
        <div class="col-md-8">
            <h1>Community</h1>
            @foreach ($links as $link)
            <li>
                <a href="{{$link->link}}" target="_blank">
                    {{$link->title}}
                </a>
                <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>
            </li>
            @endforeach

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Contribute a link</h3>
                </div>
                <div class="card-body">
                    @include('profile.partials.add-link')
                </div>
            </div>

        </div>
    </div>
    {{$links->links()}}

</div>


@stop