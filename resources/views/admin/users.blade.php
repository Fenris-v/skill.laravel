@extends('admin.layouts.layout')

@section('title', 'Административная панель')

@section('content')

    <div>
        <h2 class="h2">Группы</h2>
        <ul class="d-flex flex-wrap list-unstyled">
            <li class="mr-3">
                <a class="btn btn-primary {{ url()->current() === route('admin.users') ? 'active' : '' }}"
                   href="{{ route('admin.users') }}">Все</a>
            </li>
            @foreach(\App\Models\Group::all() as $group)
                <li class="mr-3">
                    <a class="btn btn-primary {{ url()->current() === route('admin.users.group', $group->id) ? 'active' : '' }}"
                       href="{{ route('admin.users.group', $group->id) }}">{{ $group->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Имя</th>
            <th scope="col">Почта</th>
            <th scope="col">Почта подтверждена</th>
            <th scope="col">Дата регистрации</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th class="font-weight-normal" scope="col">{{ $user->name }}</th>
                <th class="font-weight-normal" scope="col">{{ $user->email }}</th>
                <th class="font-weight-normal"
                    scope="col">{{ $user->email_verified_at ? $user->email_verified_at->isoFormat('D MMM YYYY H:m:s') : '' }}</th>
                <th class="font-weight-normal"
                    scope="col">{{ $user->updated_at ? $user->updated_at->isoFormat('D MMM YYYY H:m:s') : '' }}</th>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
