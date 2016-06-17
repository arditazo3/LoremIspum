<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function showProfile() {

        $user = Auth::user();

        $rootUrl = Option::findOrFail(1)->value;

        return view('webapp-layouts.my_account.my_profile', compact(['user', 'rootUrl']));
    }

    public function showContacts() {

        return view('webapp-layouts.my_account.contacts');
    }

    public function showMailbox() {

        return view('webapp-layouts.my_account.mailbox');
    }

    public function updateProfile(Request $request) {

    }

}
