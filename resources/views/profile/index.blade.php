@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-2">
        <div class="col-md-8">
            @if (count($profile) != 0)
            
            <h2>{{$profile->name}}</h2>
            
            <table class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>
                            @if ($show == 1)
                            
                            <h2>
                                <a href="/community/">Community</a> - {{$links[0]->channel->title}}
                            </h2>
                                                    
                            @else

                            <h2>Community</h2>
                            
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @include('partials.lista-links')
                </tbody>
            </table>
            
            @else
            
            <h2>Community</h2>
            
            <h3>No existe un profile</h3>
            
            @endif

        </div>
        @auth
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Contribute a link</h3>
                </div>
                <div class="card-body">
                    @include('partials.add-link')
                </div>
            </div>

        </div>
        @endauth
    </div>
    {{$links->links()}}

</div>


@stop