<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialAccountService;
use Laravel\Socialite\Facades\Socialite;

class SocialAccountController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    public function handleProviderCallback(SocialAccountService $accountService, $provider)
    {
        try {
            $user = Socialite::with($provider)->user();
        } catch (\Exception $e) {
            return to_route('login');
        }

        $authUser = $accountService->findOrCreate(
            $user,
            $provider
        );

        auth()->login($authUser, true);

        return to_route('home');
    }
}
