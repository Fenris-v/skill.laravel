@extends('layout.layout')

@section('title', 'Админка')

@section('content')

    <main role="main" class="container pt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Почта</th>
                        <th scope="col">Сообщение</th>
                        <th scope="col">Получено</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($callbacks as $callback)
                        <tr>
                            <td>{{ $callback->email }}</td>
                            <td>{{ $callback->message }}</td>
                            <td>{{ $callback->created_at->isoFormat('D MMM YYYY') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div><!-- /.row -->

    </main><!-- /.container -->
@endsection
