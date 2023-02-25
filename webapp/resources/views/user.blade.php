@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
        @if ($edit == 0)
            @foreach ($users as $user)
                <livewire:show-user :user="$user" :wire:key="$user->id">
            @endforeach
            @if (count($users) > 1){{ $users->links() }}@endif
            @if (count($users) < 1) Нет пользователей. @endif
        @endif
        @if ($edit == 1)
            <livewire:edit-user :user="$user" :wire:key="$user->id">
        @endif
        </div>
    </div>
</div>
@endsection
