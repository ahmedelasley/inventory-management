<?php

namespace App\Http\Controllers\Supervisor\Auth;

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
        $supervisor = Auth::guard('supervisor')->user();
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password:supervisor'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $supervisor->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
