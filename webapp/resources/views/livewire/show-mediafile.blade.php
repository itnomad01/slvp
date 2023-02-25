@if (in_array(Auth::user()->access_level, [1, 3, 4]))
<div class="card my-4">
    <div class="card-header">{{ $mediafile->id }} Автор: {{ $mediafile->user->name }} {{ $mediafile->org->brandtitle }} Создано: {{ date_format(date_create($mediafile->created_at), 'd.m.Y H:i:s') }}, изменён {{ date_format(date_create($mediafile->updated_at), 'd.m.Y H:i:s') }}.</div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Контрольная сумма SHA-256</dt>
            <dd class="col-sm-9">{{ bin2hex($mediafile->sha256checksum) }}</dd>
            <dt class="col-sm-3">URI</dt>
            <dd class="col-sm-9"><a target="_blank" href="{{ Storage::url($mediafile->uri) }}">{{ Storage::url($mediafile->uri) }}</a></dd>
        </dl>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-outline-danger" wire:click="delete">Удалить</button>
    </div>
</div>
@endif
