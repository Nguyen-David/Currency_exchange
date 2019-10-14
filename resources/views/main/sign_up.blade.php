@extends('main.layouts.header')

@section ('content')
<form class="form-signin" method="post" action="{{route('sign_up_complete')}}">
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @csrf
    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label class="red" for="name">Имя</label>
            <input type="text" class="form-control" id="name" placeholder="Имя" name="name" value="{{old('name')}}">
        </div>
        <div class="col-md-6">
            <label class="red" for="surname">Фамилия</label>
            <input type="text" class="form-control" id="surname" placeholder="Фамилия" name="surname" value="{{ old('surname') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="email" for="email">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="Email" name="email" {{ old('email') }}>
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" id="user_password" placeholder="Password" name="password">
    </div>
    <div class="mb-4">
        <small class="form-text text-muted info-reg">При регистрации нового пользователя на вашем счету доступно 5000 грн</small>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        <a href="{{ route('login') }}" class="registration-btn">Вход</a>
    </div>
</form>
@endsection

@extends('main.layouts.footer')
