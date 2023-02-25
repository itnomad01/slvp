<form wire:submit.prevent="save" class="mt-2">
    @if ($edit == 1)
    @if ($post->rtmp_status == true)
    <div class="mb-3" wire:ignore>
        <video-js style="display: block; width: 100%" class="vjs-theme-city" id="hls" controls preload="none" @if($post->picture)poster="{{ Storage::url($post->picture->uri) }}"@endif data-setup='{}'>
            <source src="{{ env('APP_URL').':81/hls/'.$post->stream_name }}" type="application/x-mpegURL">
        </video-js>
    </div>
    @endif
    @if (($post->file_preparation == true) and ($post->rtmp_status == false))
    <div class="mb-3 alert alert-warning" role="alert">Идёт обработка записанных данных.</div>
    @endif
    @if (($post->file_preparation == false) and ($post->rtmp_status == false) and ($post->video))
    <div class="mb-3" wire:ignore>
        <video-js style="display: block; width: 100%" class="vjs-theme-city" id="hls" controls preload="none" @if($post->picture)poster="{{ Storage::url($post->picture->uri) }}"@endif data-setup='{}'>
            <source src="{{ Storage::url($post->video->uri) }}" type="video/mp4">
        </video-js>
    </div>
    @endif
    <div class="mb-3" wire:poll="refreshbuttons">
        RTMP: {{ $post->rtmp_ip_sender }}@if($post->rtmp_status )<i class="bi bi-brightness-low-fill fs-4" style="color: green"></i>{{ $post->timepass }}@else<i class="bi bi-brightness-low-fill fs-4" style="color: red"></i>@endif
        <button type="button" class="btn btn-outline-danger" wire:click="stop">Стоп</button>
        <button type="button" class="btn btn-primary" wire:click="startrec" {{ $startrec_dis }}>Начать запись</button>
        <button type="button" class="btn btn-secondary" wire:click="stoprec" {{ $stoprec_dis }}>Остановить запись</button>
    </div>
    @endif
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="autorecord" wire:model.defer="post.autorecord">
        <label for="autorecord" class="form-check-label">Начать запись при поступлении данных RTMP</label>
    </div>
    <div class="mb-3 form-floating">
        <input type="text" class="form-control" id="title1" wire:model.defer="post.title1" required>
        <label for="title1" class="form-label">Заголовок 1</label>
    </div>
    <div class="mb-3 form-floating">
        <input type="text" class="form-control" id="title2" wire:model.defer="post.title2">
        <label for="title2" class="form-label">Заголовок 2</label>
    </div>
    <div class="mb-3 form-floating">
        <input type="datetime-local" class="form-control" id="dt_begin" wire:model.defer="post.dt_begin" required>
        <label for="dt_begin" class="form-label">Начало</label>
    </div>
    <div class="mb-3 form-floating">
        <input type="datetime-local" class="form-control" id="dt_end" wire:model.defer="post.dt_end" required>
        <label for="dt_end" class="form-label">Конец</label>
    </div>
    <div class="mb-3 form-floating">
        <input type="number" class="form-control" id="price" wire:model.defer="post.price" required>
        <label for="price" class="form-label">Цена</label>
    </div>
    <div class="mb-3 form-floating">
        <input type="number" class="form-control" id="timeleft" wire:model.defer="post.timeleft">
        <label for="timeleft" class="form-label">Таймлефт</label>
    </div>
    <div class="mb-3">
        <p>В подписках</p>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">Подписка 1</label>
        </div>
    </div>
    <div class="mb-3 form-floating">
        <textarea class="form-control" id="body" style="height: 200px" wire:model.defer="post.body"></textarea>
        <label for="body" class="form-label">Текст</label>
    </div>
    <div class="mb-3 form-floating">
        <div class="color-picker"></div>
        <input type="text" class="form-control" id="color" maxlength="9" value="" wire:model.defer="inputcolor">
        <label for="color" class="form-label my-3">Цвет</label>
    </div>
    <div class="mb-3">
        <input type="file" accept="image/*" class="form-control" id="picturefile" wire:model.defer="picturefile">
        <label for="picturefile" class="form-label">Картинка</label>
    </div>
    <div class="mb-3 form-floating">
        <input type="text" class="form-control" id="stream_name" readonly value="{{ env('RTMP_INGEST').'/'.$post->stream_name }}">
        <label for="stream_name" class="form-label">Путь/имя трансляции</label>
    </div>
    <div class="mb-3 form-floating">
        <input type="text" class="form-control" id="stream_token" readonly value="{{ $stream_token }}">
        <label for="stream_token" class="form-label">Ключ трансляции</label>
        @if ($edit == 1) <button type="button" class="btn btn-secondary btn-sm my-1" wire:click="gentoken">Новый ключ</button> @endif
    </div>
    <div class="mb-3 form-floating">
        <input type="text" class="form-control" id="stream_string" readonly value="{{ env('RTMP_INGEST').'/'.$post->stream_name.'?token='.$post->stream_token }}">
        <label for="stream_string" class="form-label">Путь/имя/ключ трансляции</label>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-outline-primary">@if ($edit == 2) Создать @endif @if ($edit == 1) Изменить @endif</button>
        <button type="button" class="btn btn-outline-success" onclick='location.href="{{ route('posts', ['id' => $post->id]) }}"'>Просмотреть</button>
    </div>
</form>
