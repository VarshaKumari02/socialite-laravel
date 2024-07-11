<?php

namespace Varsha\Socialite\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Varsha\Socialite\Library\Application\FacebookCallbackHandler;

/**
 * FacebookController class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
class FacebookController extends Controller
{
    /**
     * FacebookCallbackHandler instance
     *
     * @var FacebookCallbackHandler
     */
    protected $facebookCallbackHandler;

    /**
     * Constructor
     *
     * @param FacebookCallbackHandler $facebookCallbackHandler
     */
    public function __construct(FacebookCallbackHandler $facebookCallbackHandler)
    {
        $this->facebookCallbackHandler = $facebookCallbackHandler;
    }
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback()
    {
        if ($this->facebookCallbackHandler->handle()) {
            return redirect()->intended('/');
        } else {
            return redirect('auth/login');
        }
    }

}
// end of class FacebookController
// end of file FacebookController.php