<?php

namespace App\Http\Controllers\Supervisor;
use App\Http\Controllers\Controller;
use App\Models\Supervisor;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(): View
    {
        return view('supervisor.pages.profile.index',[
            'profile' => Auth::guard('supervisor')->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $supervisor = Auth::guard('supervisor')->user();

        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Supervisor::class)->ignore($supervisor->id)],
        ]);

        $supervisor->fill($validate);

        if ($supervisor->isDirty('email')) {
            $supervisor->email_verified_at = null;
        }

        $supervisor->save();

        return Redirect::route('supervisor.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password:supervisor'],
        ]);

        $user = Auth::guard('supervisor')->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
