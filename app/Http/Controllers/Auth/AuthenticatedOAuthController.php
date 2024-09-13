<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepositoryInterface;

class AuthenticatedOAuthController extends Controller
{

    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * Handle an incoming authentication request.
     */
    public function googleAuth(Request $request): RedirectResponse
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            Log::error('AuthenticatedOAuthController::store' . $e);
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Handle a google callback request.
     */
    public function googleCallback(Request $request): RedirectResponse
    {
        try {
            $goUser = Socialite::driver('google')->user();
            $user = $this->userRepository->oauth('google_id', $goUser->id, [
                'name' => $goUser->name,
                'email' => $goUser->email,
                'google_id' => $goUser->id,
                'avatar' => $goUser->avatar,
            ]);

            if ($user) {
                Auth::login($user);
                return redirect(route('dashboard', absolute: false));
            }

            return back()->withErrors(['error' => 'Have an error!']);
        } catch (\Exception $e) {
            Log::error('AuthenticatedOAuthController::store' . $e);
            return redirect('/login')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
