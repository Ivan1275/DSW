@extends('layouts.app')

@section('content')
<div class="container ms-3 me-3">
    <div class="row pt-2">
        <div class="col-md-8">
            <h1>Community</h1>
            @if (count($links) != 0)

            @include('profile.partials.lista-links')

            @else
            
            <h3>No tengo ningun link que mostrar. Crea uno!</h3>
            
            @endif

        </div>
        @auth
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
        @endauth
    </div>
    {{$links->links()}}

</div>


@stop