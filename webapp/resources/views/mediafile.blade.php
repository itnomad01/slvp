@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
        <button type="button" class="btn btn-outline-primary my-8" onclick='location.href="{{ route('addmediafile') }}"'>Добавить медиафайл</button>
        @if ($edit == 0)
            @foreach ($mediafiles as $mediafile)
                <livewire:show-mediafile :mediafile="$mediafile" :wire:key="$mediafile->id">
            @endforeach
            {{ $mediafiles->links() }}
            @if (count($mediafiles) < 1) Нет медиафайлов. @endif
        @endif
        @if ($edit == 1)
            <livewire:edit-mediafile :mediafile="$mediafile" :wire:key="$mediafile->id" :edit="1">
        @endif
        @if ($edit == 2)
            <livewire:edit-mediafile :edit="2">
        @endif
        </div>
    </div>
</div>
@endsection
