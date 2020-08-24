@extends('layout.layout')

@section('title', 'Контакты')

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">

                <h2>Контакты</h2>
                <hr>
                <h3>Телефон: <a href="#">+7 999 999 99 99</a></h3>
                <h3>Почта: <a href="#">no@gmail.com</a></h3>

                <hr>

                @include('layout.callback')

            </div>

            @include('layout.side')

        </div><!-- /.row -->

    </main><!-- /.container -->
@endsection
