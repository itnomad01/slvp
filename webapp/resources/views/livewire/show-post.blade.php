<div class="card my-4">
    <div class="card-header">@if (in_array(Auth::user()->access_level, [1, 3, 4])) Автор: {{ $post->user->name }} @endif {{ $post->org->brandtitle }} Создано: {{ date_format(date_create($post->created_at), 'd.m.Y H:i:s') }}, изменён {{ date_format(date_create($post->updated_at), 'd.m.Y H:i:s') }}. {{ $post->cv }} просмотров, из них {{ $post->cv_before }}, инлайв {{ $post->cv_live }}, после {{ $post->cv_after }} </div>
    @if (($post->picture) and (date_create($post->dt_begin) > now())) <img src="{{ Storage::url($post->picture->uri) }}" class="card-img-top"> @endif
    <div class="card-body">
    @if(count($post->tickets) > 0)
        @if (($post->rtmp_status == true) and (date_create($post->dt_begin) < now()) and (date_create($post->dt_end) > now()))
        <div class="mb-3" wire:ignore>
            <video-js style="display: block; width: 100%" class="vjs-theme-city" id="hls" controls preload="none" @if($post->picture)poster="{{ Storage::url($post->picture->uri) }}"@endif data-setup='{}'>
                <source src="{{ env('APP_URL').':81/hls/'.$post->stream_name }}" type="application/x-mpegURL">
            </video-js>
        </div>
        @endif
        @if (($post->file_preparation == true) and ($post->rtmp_status == false))
        <div class="mb-3 alert alert-warning" role="alert">Идёт обработка записанных данных.</div>
        @endif
        @if (($post->file_preparation == false) and ($post->rtmp_status == false) and ($post->video) and (date_create($post->dt_end) < now()))
        <div class="mb-3" wire:ignore>
            <video-js style="display: block; width: 100%" class="vjs-theme-city" id="hls" controls preload="none" @if($post->picture)poster="{{ Storage::url($post->picture->uri) }}"@endif data-setup='{}'>
                <source src="{{ Storage::url($post->video->uri) }}" type="video/mp4">
            </video-js>
        </div>
        @endif
    @endif
        <h5 class="card-title">{{ $post->title1 }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $post->title2 }}</h6>
        <dl class="row">
            <dt class="col-sm-3">Начало</dt>
            <dd class="col-sm-9">{{ date_format(date_create($post->dt_begin), 'd.m.Y H:i:s') }}</dd>
            <dt class="col-sm-3">Конец</dt>
            <dd class="col-sm-9">{{ date_format(date_create($post->dt_end), 'd.m.Y H:i:s') }}</dd>
            <dt class="col-sm-3">Цена</dt>
            <dd class="col-sm-9">{{ $post->price }}</dd>
            <dt class="col-sm-3">Таймлефт</dt>
            <dd class="col-sm-9">{{ $post->timeleft }}</dd>
            <dt class="col-sm-3">В подписках</dt>
            <dd class="col-sm-9"></dd>
        </dl>
        <p class="card-text">{{ $post->body }}</p>
        @if (in_array(Auth::user()->access_level, [1, 3, 4]))
        <dl class="row">
            <dt class="col-sm-3">Путь/имя трансляции</dt>
            <dd class="col-sm-9">{{ env('RTMP_INGEST').'/'.$post->stream_name }}</dd>
            <dt class="col-sm-3">Ключ трансляции</dt>
            <dd class="col-sm-9">{{ $post->stream_token }}</dd>
            <dt class="col-sm-3">Путь/имя/ключ</dt>
            <dd class="col-sm-9">{{ env('RTMP_INGEST').'/'.$post->stream_name.'?token='.$post->stream_token }}</dd>
        </dl>
        @endif
    </div>
    <div class="card-footer">
        @if(in_array(Auth::user()->access_level, [1, 3, 4]))
        <span wire:poll>RTMP: {{ $post->rtmp_ip_sender }}@if($post->rtmp_status )<i class="bi bi-brightness-low-fill fs-4" style="color: green"></i>{{ $post->timepass }}@else<i class="bi bi-brightness-low-fill fs-4" style="color: red"></i>@endif</span>
        <button type="button" class="btn btn-outline-warning" onclick='location.href="{{ route('editpost', ['id' => $post->id]) }}"'>Изменить</button>
        <button type="button" class="btn btn-outline-danger" wire:click="delete">Удалить</button>
        @endif
        @if(count($post->tickets) > 0) Билет куплен.
        @else
        <form id="ticketbuy-org{{$post->org_id}}-post{{$post->id}}" method="POST" action="{{ route('ticketbuy') }}">@csrf
            <input name="org_id" type="hidden" value="{{$post->org_id}}">
            <input name="post_id" type="hidden" value="{{$post->id}}">
            <input name="user_id" type="hidden" value="{{Auth::id()}}">
            <button type="submit" class="btn btn-outline-success">Купить</button>
        </form>
        @endif
    </div>
</div>
