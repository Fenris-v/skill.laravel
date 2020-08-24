@extends('layout.layout')

@section('title', 'Fenris - Laravel')

@section('content')

    @include('main.top')

    <main role="main" class="container">
        <div class="row">

            @include('main.main')

            @include('layout.side')

        </div><!-- /.row -->

    </main><!-- /.container -->
@endsection
