<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DemoLoginController extends Controller
{
    public function __invoke(string $role): RedirectResponse
    {
        $email = $role === 'admin'
            ? 'adminpbkk@its.ac.id'
            : 'stafpbkk@its.ac.id';

        $user = User::where('email', $email)->firstOrFail();
        Auth::login($user);

        return to_route('dashboard');
    }
}
