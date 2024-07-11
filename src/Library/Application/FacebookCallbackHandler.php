<?php

namespace Varsha\Socialite\Library\Application;

use Illuminate\Support\Facades\Auth;
use Varsha\Socialite\Models\User;
use Laravel\Socialite\Facades\Socialite;

/**
 * FacebookCallbackHandler
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
class FacebookCallbackHandler
{
    /**
     * Handle the Facebook login callback.
     *
     * @return bool
     */
    public function handle()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return false;
        }

        $userData = [
            'name' => $facebookUser->getName(),
            'email' => $facebookUser->getEmail(),
            'facebook_id' => $facebookUser->getId(),
        ];

        $user = User::where('email', $userData['email'])->first();

        if (!$user) {
            $user = $this->createUser($userData);
        } else {
            $this->updateUserFacebookId($user, $userData['facebook_id']);
        }

        Auth::login($user);

        return true;
    }

     /**
     * Create a new user with the provided data.
     *
     * @param array $userData
     * @return $user
     */
    protected function createUser(array $userData)
    {
        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'facebook_id' => $userData['facebook_id'],
        ]);
        return $user;
    }

    /**
     * Update the Facebook ID of an existing user.
     *
     * @param $user
     * @param string $facebookId
     * @return void
     */
    protected function updateUserFacebookId(User $user, string $facebookId)
    {
        $user->update(['facebook_id' => $facebookId]);
    }
}
// end of class FacebookCallbackHandler
// end of file FacebookCallbackHandler.php