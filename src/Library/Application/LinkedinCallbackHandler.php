<?php

namespace Varsha\Socialite\Library\Application;

use Illuminate\Support\Facades\Auth;
use Varsha\Socialite\Models\User;
use Laravel\Socialite\Facades\Socialite;

/**
 * LinkedinCallbackHandler
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
class LinkedinCallbackHandler
{
    /**
     * Handle the Linkedin login callback.
     *
     * @return bool
     */
    public function handle()
    {
        try {
            $linkedinUser = Socialite::driver('linkedin')->user();
        } catch (\Exception $e) {
            return false;
        }

        $userData = [
            'name' => $linkedinUser->getName(),
            'email' => $linkedinUser->getEmail(),
            'linkedin_id' => $linkedinUser->getId(),
        ];

        $user = User::where('email', $userData['email'])->first();

        if (!$user) {
            $user = $this->createUser($userData);
        } else {
            $this->updateUserLinkedinId($user, $userData['linkedin_id']);
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
            'linkedin_id' => $userData['linkedin_id'],
        ]);
        return $user;
    }

    /**
     * Update the Linkedin ID of an existing user.
     *
     * @param $user
     * @param string $linkedId
     * @return void
     */
    protected function updateUserLinkedinId(User $user, string $linkedinId)
    {
        $user->update(['linkedin_id' => $linkedinId]);
    }
}
// end of class LinkedinCallbackHandler
// end of file LinkedinCallbackHandler.php