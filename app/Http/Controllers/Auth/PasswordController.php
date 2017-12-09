<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
class PasswordController extends Controller
{
    public function __construct(Guard $auth, PasswordBroker $passwords)
    {
        $this->auth = $auth;
        $this->passwords = $passwords;

        $this->middleware('guest');
    }
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use RedirectsUsers;

    protected $redirectTo = '/';

    /**
     * Create a new password controller instance.
     *
     *
     */

    public function showLinkRequestForm()
    {
        $stickyFooter = true;

        return view('passwords.email', compact('stickyFooter'));

    }


    /* public function postReset2(Request $request)
     {
         $liu = User::where('email', $request->get('email', null))->first();

         if ($liu) {
                 if (isset($liu->id)) {
                     $pass = trim($request->get('password'));
                     \Log::info(bcrypt($pass));
                     $pass_conf = trim($request->get('password_confirmation'));
                     if (strlen($pass) >= 6) {
                         if ($pass_conf === $pass) {
                             $liu->forceFill([
                                 'password' => bcrypt($pass),
                                 'remember_token' => Str::random(60),
                             ])->save();
                             Notification::create([
                                 'from_user_id' => 1,
                                 'to_user_id' => $liu->id,
                                 'subject' => 'Password Changed',
                                 'message' => 'Your password has been changed'
                             ]);
                             \DB::statement("DELETE FROM password_resets WHERE email = '{$liu->email}'");
                             \Notify::success("Password Changed, continue to login");
                         } else {
                             \Notify::warning("OOPS!! Passwords doesn't match. please try again");
                             return \Redirect::back();
                         }
                     } else {
                         \Notify::warning("OOPS!! Passwords must be 6 characters, please try again.");
                         return \Redirect::back();
                     }

             } else {
                 \Notify::warning('OOPS!! The password reset link you are trying looks like expired or not available. try once again..');
             }
         }else {
             \Notify::warning('User Not Found!!!');
         }
         return \Redirect::to('/');
     }
     public function getReset2(Request $request, $token = null)
     {
         return $this->showResetForm($request, $token);
     }*/


    /**
     * Get the name of the guest middleware.
     *
     * @return string
     */
    protected function guestMiddleware()
    {
        $guard = $this->getGuard();

        return $guard ? 'guest:' . $guard : 'guest';
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmail()
    {
        return $this->showLinkRequestForm();
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    /*    public function showLinkRequestForm()
        {
            if (property_exists($this, 'linkRequestView')) {
                return view($this->linkRequestView);
            }

            if (view()->exists('auth.passwords.email')) {
                return view('auth.passwords.email');
            }

            return view('auth.password');
        }*/

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateSendResetLinkEmail($request);

        $broker = $this->getBroker();

        $response = Password::broker($broker)->sendResetLink(
            $this->getSendResetLinkEmailCredentials($request),
            $this->resetEmailBuilder()
        );

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->getSendResetLinkEmailSuccessResponse($response);
            case Password::INVALID_USER:
            default:
                return $this->getSendResetLinkEmailFailureResponse($response);
        }
    }

    /**
     * Validate the request of sending reset link.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateSendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }

    /**
     * Get the needed credentials for sending the reset link.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function getSendResetLinkEmailCredentials(Request $request)
    {
        return $request->only('email');
    }

    /**
     * Get the Closure which is used to build the password reset email message.
     *
     * @return \Closure
     */
    protected function resetEmailBuilder()
    {
        return function (Message $message) {
            $message->subject($this->getEmailSubject());
        };
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Your Password Reset Link';
    }

    /**
     * Get the response for after the reset link has been successfully sent.
     *
     * @param  string $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getSendResetLinkEmailSuccessResponse($response)
    {
        return redirect()->back()->with('status', trans($response));
    }

    /**
     * Get the response for after the reset link could not be sent.
     *
     * @param  string $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getSendResetLinkEmailFailureResponse($response)
    {
        return redirect()->back()->withErrors(['email' => trans($response)]);
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string|null $token
     * @return \Illuminate\Http\Response
     */
    public function getReset(Request $request, $token = null)
    {
        return $this->showResetForm($request, $token);
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string|null $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $token = null)
    {

        if (is_null($token)) {
            return $this->getEmail();
        }

        $email = $request->input('email');

        if (property_exists($this, 'resetView')) {
            return view($this->resetView)->with(compact('token', 'email'));
        }

        if (view()->exists('auth.passwords.reset')) {
            return view('auth.passwords.reset')->with(compact('token', 'email'));
        }

        return view('auth.reset')->with(compact('token', 'email'));
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        return $this->reset($request);
    }

    /**
     * Reset the given user's password.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request)
    {
        $this->validate(
            $request,
            $this->getResetValidationRules(),
            $this->getResetValidationMessages(),
            $this->getResetValidationCustomAttributes()
        );

        $credentials = $this->getResetCredentials($request);

        $broker = $this->getBroker();

        $response = Password::broker($broker)->reset($credentials, function ($user, $password) {
//            \Log($password);
            $this->resetPassword($user, $password);
        });

        switch ($response) {

            case Password::PASSWORD_RESET:
                $liu = User::where('email', $request->get('email'))->first();
                \DB::statement("DELETE FROM password_resets WHERE email = '{$liu->email}'");
                return $this->getResetSuccessResponse($response);
            default:
                return $this->getResetFailureResponse($request, $response);
        }
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function getResetValidationRules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * Get the password reset validation messages.
     *
     * @return array
     */
    protected function getResetValidationMessages()
    {
        return [];
    }

    /**
     * Get the password reset validation custom attributes.
     *
     * @return array
     */
    protected function getResetValidationCustomAttributes()
    {
        return [];
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function getResetCredentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

        Auth::guard($this->getGuard())->login($user);
    }

    /**
     * Get the response for after a successful password reset.
     *
     * @param  string $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResetSuccessResponse($response)
    {
        return redirect($this->redirectPath())->with('status', trans($response));
    }

    /**
     * Get the response for after a failing password reset.
     *
     * @param  Request $request
     * @param  string $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResetFailureResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return string|null
     */
    public function getBroker()
    {
        return property_exists($this, 'broker') ? $this->broker : null;
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }


}
