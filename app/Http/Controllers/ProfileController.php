<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with('bankAccounts')->findOrFail(Auth::user()->id);
        return view('auth.profile', compact('user'));
    }
}
