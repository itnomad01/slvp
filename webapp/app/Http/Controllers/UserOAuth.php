<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserOAuth extends Controller
{
    public function auth($provider)
    {
	if ($provider == 'vkontakte')
	{
            $vkUser = Socialite::driver('vkontakte')->user();
            $user = User::where('vk_id', $vkUser->id)->first();
            if ($user) {
                $user->update([
                    'vk_token' => $vkUser->token,
                    'vk_refresh_token' => $vkUser->refreshToken
                ]);
            } else {
                $user = User::create([
                    'name' => $vkUser->name,
                    'email' => $vkUser->email,
                    'vk_id' => $vkUser->id,
                    'vk_token' => $vkUser->token,
                    'vk_refresh_token' => $vkUser->refreshToken
                ]);
            }
            Auth::login($user);
        }
    }
}
