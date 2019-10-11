@extends('main.layouts.header')

@section('content')
<form class="form-signin" method="post" action="{{route('edit_complete')}}">
    @csrf
    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Редактирование профиля</h1>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label class="red" for="name">Имя</label>
            <input type="text" class="form-control" id="name" placeholder="Имя" name="name" value="{{ $user['name']}}">
        </div>
        <div class="col-md-6">
            <label class="red" for="surname">Фамилия</label>
            <input type="text" class="form-control" id="surname" placeholder="Фамилия" name="surname" value="{{ $user['surname']}}">
        </div>
    </div>
    <div class="form-group">
        <label class="email" for="email">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ $user['email']}}">
    </div>
    <div class="mb-4">
        <button type="submit" class="btn btn-primary">Редактировать</button>
        <a href="{{ route('cabinet') }}" class="registration-btn">Назад</a>
    </div>
</form>
@endsection

@extends('main.layouts.footer')
