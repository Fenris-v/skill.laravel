@extends('layout.layout')

@section('title', 'Fenris - Laravel')

@section('content')

    <main role="main" class="container">
        <div class="row">

            @include('main.main')

            @include('layout.side')

        </div>

    </main>
@endsection
