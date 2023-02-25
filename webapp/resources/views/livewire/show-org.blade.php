<div class="card my-4">
    <div class="card-header">{{ $org->title }}. Создано: {{ date_format(date_create($org->created_at), 'd.m.Y H:i:s') }}, изменёно {{ date_format(date_create($org->updated_at), 'd.m.Y H:i:s') }}.</div>
    <div class="card-body">
        <h5 class="card-title">{{ $org->brandtitle }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $org->fulltitle }}</h6>
        <dl class="row">
            <dt class="col-sm-3">ОГРН(ЮЛ/ИП)</dt>
            <dd class="col-sm-9">{{ $org->ogrn }}</dd>
            <dt class="col-sm-3">ИНН</dt>
            <dd class="col-sm-9">{{ $org->inn }}</dd>
            <dt class="col-sm-3">КПП</dt>
            <dd class="col-sm-9">{{ $org->kpp }}</dd>
            <dt class="col-sm-3">Адрес регистрации</dt>
            <dd class="col-sm-9">{{ $org->address }}</dd>
            @if(in_array(Auth::user()->access_level, [2, 3, 4]))
            <dt class="col-sm-3">Статус плательщиков, что платят ЮЛ(ИП)</dt>
            <dd class="col-sm-9">{{ $org->drawer_status }}</dd>
            <dt class="col-sm-3">Наименование получателя платежей</dt>
            <dd class="col-sm-9">{{ $org->fintitle }}</dd>
            <dt class="col-sm-3">Номер расчётного(казначейского) счёта (реквизит «17» платежного поручения)</dt>
            <dd class="col-sm-9">{{ $org->personal_acc }}</dd>
            <dt class="col-sm-3">Наименование банка получателя</dt>
            <dd class="col-sm-9">{{ $org->bank_name }}</dd>
            <dt class="col-sm-3">БИК</dt>
            <dd class="col-sm-9">{{ $org->bic }}</dd>
            <dt class="col-sm-3">Корреспондентский счёт (ЕКС) (реквизит «15» платежного поручения)</dt>
            <dd class="col-sm-9">{{ $org->corresp_acc }}</dd>
            <dt class="col-sm-3">Код бюджетной классификации</dt>
            <dd class="col-sm-9">{{ $org->kbk }}</dd>
            <dt class="col-sm-3">Назначение кода бюджетной классификации</dt>
            <dd class="col-sm-9">{{ $org->titlekbk }}</dd>
            <dt class="col-sm-3">Общероссийский классификатор территорий муниципальных образований (ОКТМО)</dt>
            <dd class="col-sm-9">{{ $org->oktmo }}</dd>
            <dt class="col-sm-3">Назначение платежа</dt>
            <dd class="col-sm-9">{{ $org->purpose }}</dd>
            <dt class="col-sm-3">E-mail</dt>
            <dd class="col-sm-9">{{ $org->email }}</dd>
            <dt class="col-sm-3">Телефон</dt>
            <dd class="col-sm-9">{{ $org->tel }}</dd>
            @endif
        </dl>
    </div>
    <div class="card-footer">
        @if(Auth::user()->access_level == 4)
        <button type="button" class="btn btn-outline-warning">Изменить</button>
        <button type="button" class="btn btn-outline-danger">Удалить</button>
        @endif
    </div>
</div>
