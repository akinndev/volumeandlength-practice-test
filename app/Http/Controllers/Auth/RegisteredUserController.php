<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\View\View;
use App\Repositories\UserRepositoryInterface;

class RegisteredUserController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        try {
            $user = $this->userRepository->store($request->validated());

            if ($user) {
                Auth::login($user);
                return redirect(route('dashboard', absolute: false));
            }
            
            return back()->withErrors(['error' => 'Have an error!']);
        } catch (\Exception $e) {
            Log::error('RegisteredUserController::store' . $e);
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
