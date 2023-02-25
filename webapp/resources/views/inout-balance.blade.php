@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 bg-white rounded-3">
        <table class="table table-striped my-4">
            <thead><tr><th>Пользователь (ID)</th><th>Организация (ИНН)</th><th>Баланс</th><th>Действие</th><th>ID / дата / сумма последней операции</th></tr></thead>
            <tbody>
            @foreach ($inouts as $inout)
                <tr><td>{{ $inout->user->name }} ({{ $inout->user->id }})</td><td>{{ $inout->org->title }} ({{ $inout->org->inn }})</td><td>{{ $inout->total }}</td><td>
                <form id="topupbalance-user{{$inout->user_id}}-org{{$inout->org_id}}" class="mt-2" target="_blank" method="POST" action="{{ route('getkvit') }}">@csrf
                    <input name="user_id" type="hidden" value="{{$inout->user_id}}">
                    <input name="org_id" type="hidden" value="{{$inout->org_id}}">
                    <button type="submit" class="btn btn-outline-success">Пополнить</button>
                </form>
                </td><td>{{ $inout->id }} / {{ date('d.m.Y', strtotime($inout->created_at)) }} / {{ $inout->sum }}</td></tr>
            @endforeach
            </tbody>
        </table>
        {{ $inouts->links() }}
        @if (count($inouts) < 1) Нет операций. @endif
        </div>
    </div>
</div>
@endsection
