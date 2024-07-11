<?php

namespace Varsha\Socialite\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Varsha\Socialite\Library\Application\LinkedinCallbackHandler;

/**
 * LinkedinController class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
class LinkedinController extends Controller
{
    /**
     * LinkedinCallbackHandler instance
     *
     * @var LinkedinCallbackHandler
     */
    protected $linkedinCallbackHandler;

    /**
     * Constructor
     *
     * @param LinkedinCallbackHandler $linkedinCallbackHandler
     */
    public function __construct(LinkedinCallbackHandler $linkedinCallbackHandler)
    {
        $this->linkedinCallbackHandler = $linkedinCallbackHandler;
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleLinkedinCallback()
    {
        if ($this->linkedinCallbackHandler->handle()) {
            return redirect()->intended('/');
        } else {
            return redirect('auth/login');
        }
    }

}
// end of class LinkedinController
// end of file LinkedinController.php