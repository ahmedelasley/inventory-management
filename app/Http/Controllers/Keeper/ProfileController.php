<?php

namespace App\Http\Controllers\Keeper;
use App\Http\Controllers\Controller;
use App\Models\Keeper;

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
        return view('keeper.pages.profile.index',[
            'profile' => Auth::guard('keeper')->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $keeper = Auth::guard('keeper')->user();

        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Keeper::class)->ignore($keeper->id)],
        ]);

        $keeper->fill($validate);

        if ($keeper->isDirty('email')) {
            $keeper->email_verified_at = null;
        }

        $keeper->save();

        return Redirect::route('keeper.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password:keeper'],
        ]);

        $user = Auth::guard('keeper')->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
