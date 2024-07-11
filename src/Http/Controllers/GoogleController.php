<?php

namespace Varsha\Socialite\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Varsha\Socialite\Library\Application\GoogleCallbackHandler;

/**
 * GoogleController class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Varsha Kumari <varsha.kumari@ahex.co.in>
 */
class GoogleController extends Controller
{
    /**
     * GoogleCallbackHandler instance
     *
     * @var GoogleCallbackHandler
     */
    protected $googleCallbackHandler;

    /**
     * Constructor
     *
     * @param GoogleCallbackHandler $googleCallbackHandler
     */
    public function __construct(GoogleCallbackHandler $googleCallbackHandler)
    {
        $this->googleCallbackHandler = $googleCallbackHandler;
    }

    /**
     * Display the login form
     *
     * This method returns the view for the socialite login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login');
    }
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        if ($this->googleCallbackHandler->handle()) {
            return redirect()->intended('/');
        } else {
            return redirect('auth/login');
        }
    }

}
// end of class GoogleController
// end of file GoogleController.php