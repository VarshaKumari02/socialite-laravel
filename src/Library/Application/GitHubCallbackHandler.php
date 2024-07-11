<?php

namespace Varsha\Socialite\Library\Application;

use Varsha\Socialite\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

/**
 * GitHubCallbackHandler
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
class GitHubCallbackHandler
{
    /**
     * Handle the GitHub login callback.
     *
     * @return bool
     */
    public function handle()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
        } catch (\Exception $e) {
            return false;
        }

        $userData = [
            'name' => $githubUser->getName(),
            'email' => $githubUser->getEmail(),
            'github_id' => $githubUser->getId(),
        ];

        $user = User::where('email', $userData['email'])->first();

        if (!$user) {
            $user = $this->createUser($userData);
        } else {
            $this->updateUserGitHubId($user, $userData['github_id']);
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
            'github_id' => $userData['github_id'],
        ]);

        return $user;
    }

    /**
     * Update the GitHub ID of an existing user.
     *
     * @param $user
     * @param string $githubId
     * @return void
     */
    protected function updateUserGitHubId(User $user, string $githubId)
    {
        $user->update(['github_id' => $githubId]);
    }
}
// end of class GitHubCallbackHandler
// end of file GitHubCallbackHandler.php