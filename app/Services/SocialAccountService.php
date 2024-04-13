<?php

namespace App\Services;

use App\Models\LinkedSocialAccount;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
	public function findOrCreate(ProviderUser $providerUser, $provider)
	{
		$account = LinkedSocialAccount::where('provider_name', $provider)
			->where('provider_id', $providerUser->getId())
			->first();

		if ($account) {
			return $account->user;
		} else {

			$user = User::firstWhere('email', $providerUser->getEmail());

			if (!$user) {
				$user = User::create([
					'email' => $providerUser->getEmail(),
					'name'  => $providerUser->getName(),
				]);

				$user->assignRole('pet-owner');
			}

			$user->accounts()->create([
				'provider_id'   => $providerUser->getId(),
				'provider_name' => $provider,
			]);

			return $user;
		}
	}
}
