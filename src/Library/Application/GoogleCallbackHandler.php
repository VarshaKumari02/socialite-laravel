<?php

namespace Varsha\Socialite\Library\Application;

use Illuminate\Support\Facades\Auth;
use Varsha\Socialite\Models\User;
use Laravel\Socialite\Facades\Socialite;

/**
 * GoogleCallbackHandler
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
class GoogleCallbackHandler
{
    /**
     * Handle the Google login callback.
     *
     * @return bool
     */
    public function handle()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return false;
        }

        $userData = [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
        ];

        $user = User::where('email', $userData['email'])->first();

        if (!$user) {
            $user = $this->createUser($userData);
        } else {
            $this->updateUserGoogleId($user, $userData['google_id']);
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
            'google_id' => $userData['google_id'],
        ]);
        return $user;
    }

    /**
     * Update the Google ID of an existing user.
     *
     * @param $user
     * @param string $googleId
     * @return void
     */
    protected function updateUserGoogleId(User $user, string $googleId)
    {
        $user->update(['google_id' => $googleId]);
    }
}
// end of class GoogleCallbackHandler
// end of file GoogleCallbackHandler.php