@extends('main.layouts.header')

@section('content')
    <form class="form-signin" action="">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal"></h1>
        </div>
        <div class="form-group">
            <label class="red" for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="email">
        </div>
        <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" class="form-control" id="user_password" placeholder="Password">
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Войти</button>
            <a href="{{ route('sign_up') }}" class="registration-btn">Регистрация</a>
        </div>
    </form>
@endsection

@extends('main.layouts.footer')
