@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 bga rounded-3">
            <h3 class="mt-4">Покупка билета</h3>
            <p>Организация-продавец: <b>{{$ot->id}} {{$ot->title}} {{$ot->inn}}</b></p>
            <p>Баланс: <b>{{$uobalance}} руб.</b><form id="topupbalance-user{{$pu->id}}-org{{$ot->id}}" target="_blank" method="POST" action="{{ route('getkvit') }}">@csrf<input name="user_id" type="hidden" value="{{$pu->id}}"><input name="org_id" type="hidden" value="{{$ot->id}}"><button type="submit" class="btn btn-outline-success">Пополнить</button></form></p>
            <h4>{{$bp->title1}}</h4>
            <p>Стоимость: <b>{{$bp->price}} руб.</b></p>
            @if($uobalance < $bp->price)
            <div class="alert alert-danger" role="alert">На Вашем балансе недостаточно средств. Пожалуйста, пополните баланс не менее, чем на {{$bp->price - $uobalance}} руб.</div>
            @else
            <form id="ticketbuy" class="mb-4" method="POST" action="{{ route('ticketbuysubmit') }}">@csrf
                <input name="org_id" type="hidden" value="{{$ot->id}}">
                <input name="post_id" type="hidden" value="{{$bp->id}}">
                <div class="mb-3 form-floating">
                    <input type="number" class="form-control" id="user_id" name="user_id" required readonly value="{{$pu->id}}">
                    <label for="user_id" class="form-label">ID пользователя-приобретателя</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" class="form-control" id="pu" readonly disabled value="{{$pu->id}}">
                    <label for="pu" class="form-label">ID пользователя-плательщика</label>
                </div>
                <button type="submit" class="btn btn-outline-success">Купить</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
