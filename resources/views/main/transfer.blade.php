@extends('main.layouts.header')

@section('content')


    <form method="post" class="form-signin" action="{{ route('transfer_store') }}">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @if (session('value') && session('valute'))
                <div class="alert alert-success">
                    Результат преревода: {{ session('value') }} {{ session('valute') }}
                </div>
            @endif
        @csrf
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal"></h1>
        </div>
        <div class="form-group">
            <label for="valute">Выбирите валюту в какую переводить</label>
            <select id="valute" class="form-control" name="valute">
                <option value="USD" selected>Доллар</option>
                <option value="EUR">Евро</option>
                <option value="RUR">Рубль</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sum_money">Сумма перевода</label>
            <input type="text" class="form-control" id="sum_money" placeholder="Сумма перевода" name="money">
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Перечислить</button>
            <a href="{{route('cabinet')}}" class="registration-btn">Назад</a>
        </div>
    </form>
@endsection

@extends('main.layouts.footer')
