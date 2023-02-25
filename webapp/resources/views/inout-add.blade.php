@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h3>Ввод операции</h3>
            <form class="mt-2" method="POST" action="{{ route('addinout') }}">@csrf
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" id="title_doc" name="title_doc" required>
                    <label for="title_doc" class="form-label">Наименование документа</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" id="number_doc" name="number_doc" required>
                    <label for="number_doc" class="form-label">Номер документа</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="date" class="form-control" id="date_doc" name="date_doc" required>
                    <label for="date_doc" class="form-label">Дата документа</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" class="form-control" id="user_id" name="user_id" required>
                    <label for="user_id" class="form-label">ID пользователя</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" min="0" value="0" step="0.01" class="form-control" id="sum" name="sum" required>
                    <label for="sum" class="form-label">Сумма (в рублях РФ)</label>
                </div>
                <button type="submit" class="btn btn-primary">Провести</button>
            </form>
        </div>
    </div>
</div>
@endsection
