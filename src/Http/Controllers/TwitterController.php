<?php

namespace Varsha\Socialite\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Varsha\Socialite\Library\Application\TwitterCallbackHandler;

/**
 * TwitterController class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
class TwitterController extends Controller
{
    /**
     * TwitterCallbackHandler instance
     *
     * @var TwitterCallbackHandler
     */
    protected $twitterCallbackHandler;

    /**
     * Constructor
     *
     * @param TwitterCallbackHandler $twitterCallbackHandler
     */
    public function __construct(TwitterCallbackHandler $twitterCallbackHandler)
    {
        $this->twitterCallbackHandler = $twitterCallbackHandler;
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleTwitterCallback()
    {
        if ($this->twitterCallbackHandler->handle()) {
            return redirect()->intended('/');
        } else {
            return redirect('auth/login');
        }
    }

}
// end of class TwitterController
// end of file TwitterController.php