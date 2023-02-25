@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100">
            <div class="card">
                <div class="card-header">Вход по логину и паролю</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-end">E-Mail</label>
                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-3 col-form-label text-md-end">Пароль</label>
                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-9 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><label class="form-check-label" for="remember">Запомнить вход</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">Войти</button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">Забыли пароль?</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">Вход (или регистрация) с помощью</div>
                <div class="card-body">
                    <a href="{{ route('LoginViaGoogle') }}" class="btn btn-outline-dark" role="button"><img src="{{ env('GOOGLE_LOGO') }}"></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
