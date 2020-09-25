@php
    use App\Models\Post;
    $posts = Post::all()
@endphp

@extends('admin.layouts.layout')

@section('title', 'Административная панель')

@section('content')

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Пользователь</th>
            <th scope="col">Заявка</th>
            <th scope="col">Дата создания</th>
        </tr>
        </thead>
        <tbody>
        @foreach($callbacks as $callback)
            <tr>
                <th class="font-weight-normal" scope="col">{{ $callback->email }}</th>
                <th class="font-weight-normal" scope="col">{{ $callback->message }}</th>
                <th class="font-weight-normal"
                    scope="col">{{ $callback->created_at ? $callback->created_at->isoFormat('D MMM YYYY H:m:s') : '' }}</th>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
