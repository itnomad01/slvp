@extends('layouts.app')

@section('content')
<div class="container"><div class="row justify-content-center"><div class="w-100">
    <section id="sectioncarousel">
        <div id="carouselposts" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            @foreach ($posts as $post)
                <div class="rounded-3 carousel-item @if($lpid == $post->id)active @endif vh80 cbi" @if($post->picture) style="background-image:url({{Storage::url($post->picture->uri)}})" @endif>
                    <div class="carousel-caption d-block">
                        <h1>{{ $post->title1 }}</h1>
                        <h4>{{ $post->title2 }}</h4>
                        <p>{{ date_format(date_create($post->dt_begin), 'd.m.Y H:i') }}</p>
                        <a type="button" class="btn btn-danger btn-lg mt-4" href="{{route('posts',$post->id)}}">Смотреть</a>
                    </div>
                </div>
            @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselposts" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Предыдущий</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselposts" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Следующий</span>
            </button>
        </div>
    </section>
    <section id="sectionnowevents">
        <div class="d-block rounded-pill bga py-1 mt-4 text-center"><h2>Сейчас</h2></div>
        <div class="justify-content-between card-group">
        @foreach($postsnow as $postnow)
            <a href="{{route('posts',$postnow->id)}}" class="card m-2 rounded-3 bga text-decoration-none link-dark" style="min-width: 240px">
                @if($postnow->picture) <img src="{{Storage::url($postnow->picture->uri)}}" class="rounded-3 card-img-top"> @endif
                <div class="card-body">
                    <div><b>{{$postnow->title1}}</b></div>
                    <div>{{ date_format(date_create($postnow->dt_begin), 'd.m.Y H:i') }}</div>
                </div>
            </a>
        @endforeach
        @if(count($postsnow) < 1) Ничего нет. @endif
        </div>
    </section>
    <section id="sectionfutureevents">
        <div class="d-block rounded-pill bga py-1 mt-4 text-center"><h2>Предстоящие события</h2></div>
        <div class="justify-content-between card-group">
        @foreach($postsfuture as $postfuture)
            <a href="{{route('posts',$postfuture->id)}}" class="card m-2 rounded-3 bga text-decoration-none link-dark" style="min-width: 240px">
                @if($postfuture->picture) <img src="{{Storage::url($postfuture->picture->uri)}}" class="rounded-3 card-img-top"> @endif
                <div class="card-body">
                    <div><b>{{$postfuture->title1}}</b></div>
                    <div>{{ date_format(date_create($postfuture->dt_begin), 'd.m.Y H:i') }}</div>
                </div>
            </a>
        @endforeach
        @if(count($postsfuture) < 1) Ничего нет. @endif
        </div>
    </section>
    <section id="sectionpastevents">
        <div class="d-block rounded-pill bga py-1 mt-4 text-center"><h2>Прошедшие события</h2></div>
        <div class="justify-content-between card-group">
        @foreach($postspast as $postpast)
            <a href="{{route('posts',$postpast->id)}}" class="card m-2 rounded-3 bga text-decoration-none link-dark" style="min-width: 240px">
                @if($postpast->picture) <img src="{{Storage::url($postpast->picture->uri)}}" class="rounded-3 card-img-top"> @endif
                <div class="card-body">
                    <div><b>{{$postpast->title1}}</b></div>
                    <div>{{ date_format(date_create($postpast->dt_begin), 'd.m.Y H:i') }}</div>
                </div>
            </a>
        @endforeach
        @if(count($postspast) < 1) Ничего нет. @endif
        </div>
    </section>
    @if(count($posts) > 1) {{$posts->links()}} @endif
    @if(count($posts) < 1) Ничего нет. @endif
</div></div></div>
@endsection
