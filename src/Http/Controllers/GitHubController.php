<?php

namespace Varsha\Socialite\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Varsha\Socialite\Library\Application\GitHubCallbackHandler;

/**
 * GitHubController class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
class GitHubController extends Controller
{
    /**
     * GitHubCallbackHandler instance
     *
     * @var GitHubCallbackHandler
     */
    protected $gitHubCallbackHandler;

    /**
     * Constructor
     *
     * @param GitHubCallbackHandler $gitHubCallbackHandler
     */
    public function __construct(GitHubCallbackHandler $gitHubCallbackHandler)
    {
        $this->gitHubCallbackHandler = $gitHubCallbackHandler;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGitHubCallback()
    {
        if ($this->gitHubCallbackHandler->handle()) {
            return redirect()->intended('/');
        } else {
            return redirect('auth/login');
        }
    }

}
// end of class GitHubController
// end of file GitHubController.php