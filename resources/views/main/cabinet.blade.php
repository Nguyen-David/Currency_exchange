@extends('main.layouts.header')

@section('content')
<div class="wrapper-container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="{{ URL::asset('assets/bank.png')}}" alt="" width="100" height="100">
        <h2>Конвертор валют</h2>
        <p class="lead">В личном кабинете ви сможете пересмотреть, редактировать свои данные, посмотреть курс валют, перевести определенную сумму по курсу или же перевести средства на другой счет</p>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card text-white bg-primary" >
                <div class="card-header">
                    <div class="header-data"><h3>Личные данные</h3></div>
                    <div class="d-flex justify-content-end"><a class="edit-data" href="{{ route('edit',['id' => $user['id']]) }}">Редактировать</a></div>
                </div>
                <div class="card-body">
                    <ul class="info-list">
                        <li class="info-list-item">{{ $user['name'].' '.$user['surname']}}</li>
                        <li class="info-list-item">{{ $user['email'] }}</li>
                        <li class="info-list-item">Номер вашей карты: <strong>{{$user->card->card_id}}</strong></li>
                        <li class="info-list-item">На вашем счету: <strong>{{$user->card->money}}</strong> грн</li>
                        <li class="info-list-item">
                            <form method="post" action="{{ route('replenish') }}">
                                @csrf
                                <button type="submit" class="btn btn-light btn-replenish">Пополнить баланс</button>
                                <input type="hidden" name="user_id" value="{{$user['id'] }}">
                            </form>
                            <form method="post" action="">
                                <button type="button" class="btn btn-light">Перевести в доллары</button>
                                <input type="hidden" name="user_id" value="{{$user['id'] }}">
                            </form>
                        </li>

                        <li class="info-list-item"><button type="button" class="btn btn-light">Перевести в евро</button></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-header"><h3>Курс валют</h3></div>
                <div class="card-body">
                    <ul class="info-list">
                        <li class="info-list-item-val">Долар - <strong>{{ $currency[0]->buy . " / ".$currency[0]->sale }}</strong></li>
                        <li class="info-list-item-val">Евро - <strong>{{ $currency[1]->buy. " / ".$currency[1]->sale }}</strong></li>
                        <li class="info-list-item-val">Рубль - <strong>{{ $currency[2]->buy. " / ".$currency[2]->sale }}</strong></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card transfer-block">
                <div class="card-header">
                    Перевести деньги на другой счет
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="amount-transfer">Введите e-mail получателя</label>
                            <input type="email" class="form-control" id="amount-transfer" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <label for="amount-transfer">Введите суму для перевода</label>
                            <input type="text" class="form-control" id="amount-transfer" placeholder="Сумма">
                        </div>
                        <div class="form-group">
                            <label for="password">Введите пароль</label>
                            <input type="password" class="form-control" id="password" placeholder="Пароль">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="commission">
                            <label class="form-check-label" for="commission">Оплатить комисию за получателя</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-transfer">Перевести</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('main.layouts.footer')
