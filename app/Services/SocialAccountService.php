<?php

namespace App\Services;

use App\Models\LinkedSocialAccount;
use App\Models\PetOwner;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
	public function findOrCreate(ProviderUser $providerUser, $provider)
	{
		$account = LinkedSocialAccount::where('provider_id', $providerUser->getId())
			->first();

		if ($account) {
			return $account->user;
		} else {
			$user = User::firstWhere('email', $providerUser->getEmail());

      try{
        DB::beginTransaction();
        if (!$user) {
          $petOwner = PetOwner::create();

          $user = new User([
            'email' => $providerUser->getEmail(),
            'name'  => $providerUser->getName()
          ]);

          $user->profile()->associate($petOwner)->save();
          $user->assignRole('pet-owner');
        }

        $user->accounts()->create([
          'provider_id'   => $providerUser->getId(),
        ]);
      } catch (\Exception $e) {
        DB::rollBack();
        abort(500);
      }

      DB::commit();
			return $user;
		}
	}
}
