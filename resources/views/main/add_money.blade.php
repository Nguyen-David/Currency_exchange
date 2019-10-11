@extends('main.layouts.header')

@section('content')


    <form method="post" class="form-signin" action="{{ route('add_money_store') }}">
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
            <h1 class="h3 mb-3 font-weight-normal"></h1>
        </div>
        <div class="form-group">
            <label for="sum_money">Сумма пополнения</label>
            <input type="text" class="form-control" id="sum_money" placeholder="Сумма пополнения" name="money">
        </div>
        <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" class="form-control" id="user_password" placeholder="Password" name="password">
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Перечислить</button>
            <a href="" class="registration-btn">Назад</a>
        </div>
    </form>
@endsection

@extends('main.layouts.footer')
