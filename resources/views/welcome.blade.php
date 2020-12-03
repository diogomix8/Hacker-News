@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark text-center shadow">
                <div class="card-body">
                    <h1 class="card-title">Hacker News Desafio</h1>
                    <h3 class="card-subtitle mb-2 text-muted">Ultimas Noticias más importantes</h3>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
            <br>

            <div class="card-columns">
                <!-- Card News -->
                <example-component></example-component>
            </div>

        </div>
    </div>
</div>
@endsection