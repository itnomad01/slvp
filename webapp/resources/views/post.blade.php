@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
        <button type="button" class="btn btn-outline-primary" onclick='location.href="{{ route('addpost') }}"'>Создать пост</button>
        @if ($edit == 0)
            @foreach ($posts as $post)
                <livewire:show-post :post="$post" :wire:key="$post->id">
            @endforeach
            @if (count($posts) > 1) {{ $posts->links() }} @endif
            @if (count($posts) < 1) Нет постов. @endif
        @endif
        @if ($edit == 1)
            <livewire:edit-post :post="$post" :wire:key="$post->id" :edit="1">
        @endif
        @if ($edit == 2)
            <livewire:edit-post :edit="2">
        @endif
        </div>
    </div>
</div>
@endsection
