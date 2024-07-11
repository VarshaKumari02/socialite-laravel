<?php

namespace Varsha\Socialite\Library\Application;

use Illuminate\Support\Facades\Auth;
use Varsha\Socialite\Models\User;
use Laravel\Socialite\Facades\Socialite;

/**
 * TwitterCallbackHandler
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
class TwitterCallbackHandler
{
    /**
     * Handle the Twitter login callback.
     *
     * @return bool
     */
    public function handle()
    {
        try {
            $twitterUser = Socialite::driver('twitter')->user();
        } catch (\Exception $e) {
            return false;
        }

        $userData = [
            'name' => $twitterUser->getName(),
            'email' => $twitterUser->getEmail(),
            'twitter_id' => $twitterUser->getId(),
        ];

        $user = User::where('email', $userData['email'])->first();

        if (!$user) {
            $user = $this->createUser($userData);
        } else {
            $this->updateUserTwitterId($user, $userData['twitter_id']);
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
            'twitter_id' => $userData['twitter_id'],
        ]);
        return $user;
    }

    /**
     * Update the Twitter ID of an existing user.
     *
     * @param $user
     * @param string $twitterId
     * @return void
     */
    protected function updateUserTwitterId(User $user, string $twitterId)
    {
        $user->update(['twitter_id' => $twitterId]);
    }
}
// end of class TwitterCallbackHandler
// end of file TwitterCallbackHandler.php