@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
        @if(Auth::user()->access_level == 4) <button type="button" class="btn btn-outline-primary my-8" onclick='location.href="{{ route('addorg') }}"'>Добавить организацию (или ИП)</button> @endif
        @if ($edit == 0)
            @foreach ($orgs as $org)
                <livewire:show-org :org="$org" :wire:key="$org->id">
            @endforeach
            @if(count($orgs) > 1){{ $orgs->links() }}@endif
            @if (count($orgs) < 1) Нет организаций или ИП. @endif
        @endif
        </div>
    </div>
</div>
@endsection
