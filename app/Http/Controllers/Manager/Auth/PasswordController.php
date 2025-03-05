<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $manager = Auth::guard('manager')->user();
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password:manager'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $manager->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
