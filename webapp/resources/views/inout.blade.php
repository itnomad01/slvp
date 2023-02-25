@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 bg-white rounded-3">
        @if(in_array(Auth::user()->access_level, [2, 3, 4])) <button type="button" class="btn btn-outline-primary mt-4" onclick='location.href="{{ route('addinout') }}"'>Добавить операцию</button> @endif
        <table class="table table-striped">
            <thead><tr><th>ID</th><th>Организация</th><th>Наименование</th><th>Номер</th><th>Дата</th><th>ID билета к посту</th><th>ID билета к подписке</th><th>Пользователь</th><th>Сальдо до</th><th>Сумма (₽)</th><th>Сальдо после</th><th>Внесена</th></tr><thead>
            <tbody>
            @foreach ($inouts as $inout)
                <tr><td>{{ $inout->id }}</td><td><a href="{{ route('orgs', $inout->org_id) }}">{{ $inout->org->inn }}</a></td><td>{{ $inout->title_doc }}</td><td>{{ $inout->number_doc }}</td><td>{{ date('d.m.Y', strtotime($inout->date_doc)) }}</td><td>{{ $inout->ticket_id }}</td><td>{{ $inout->sub_accesse_id }}</td><td><a href="{{ route('users', $inout->user_id) }}">{{ $inout->user_id }}</a></td><td>{{ $inout->beforetotal }}</td><td>{{ $inout->sum }}</td><td>{{ $inout->total }}</td><td>{{ date('d.m.Y', strtotime($inout->created_at)) }}</td></tr>
            @endforeach
            </tbody>
        </table>
        {{ $inouts->links() }}
        @if (count($inouts) < 1) Нет операций. @endif
        </div>
    </div>
</div>
@endsection
