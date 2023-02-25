<div class="card my-4">
    <div class="card-header">ID пользователя: {{ $user->id }}, создан: {{ date_format(date_create($user->created_at), 'd.m.Y H:i:s') }}, изменён {{ date_format(date_create($user->updated_at), 'd.m.Y H:i:s') }}</div>
    <div class="card-body">
        <h5 class="card-title">{{ $user->name }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $user->email }}</h6>
        <dl class="row">
            <dt class="col-sm-3">Уровень прав</dt>
            <dd class="col-sm-9">{{ $user->AL }}</dd>
            <dt class="col-sm-3">E-mail проверен</dt>
            <dd class="col-sm-9">{{ date_format(date_create($user->email_verified_at), 'd.m.Y H:i:s') }}</dd>
            <dt class="col-sm-3">Google ID</dt>
            <dd class="col-sm-9">{{ $user->google_id }}</dd>
            <dt class="col-sm-3">VK ID</dt>
            <dd class="col-sm-9">{{ $user->vk_id }}</dd>
            <dt class="col-sm-3">Yandex ID</dt>
            <dd class="col-sm-9">{{ $user->yandex_id }}</dd>
            <dt class="col-sm-3">Instagram ID</dt>
            <dd class="col-sm-9">{{ $user->instagram_id }}</dd>
            <dt class="col-sm-3">Организация</dt>
            <dd class="col-sm-9">@if($user->org){{ $user->org->title }}@endif</dd>
        </dl>
    </div>
    <div class="card-footer">
        @if (in_array(Auth::user()->access_level, [3, 4]))
        <button type="button" class="btn btn-outline-warning" onclick='location.href="{{ route('edituser', ['id' => $user->id]) }}"'>Изменить</button>
        <button type="button" class="btn btn-outline-danger">Удалить</button>
        @endif
    </div>
</div>
