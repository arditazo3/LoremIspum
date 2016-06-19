<?php

namespace App\Http\Controllers;

use App\Image;
use App\Option;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        // Validation
        $this->validate($request, [
            'first_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
        ]);

        $inputs = $request->all();

        // check if the password field is not set remove it from array
        if($request->password == "") {
            $inputs = $request->except('password');
            $inputs = $request->except('confirm_password');
        } else {
            $inputs = $request->except('confirm_password');
            $inputs['password'] = bcrypt( $request->password );
        }

        // Check if file exist
        if($file = $request->file('file')) {

            $pathFolderPhotosUpload = 'imagesUpload';

            $pathComplete = $pathFolderPhotosUpload . '/' . time() . '_' . $file->getClientOriginalName();

            $file->move($pathFolderPhotosUpload, $pathComplete);

            $image = Image::create(['path'=>$pathComplete]);

            $inputs['image_id'] = $image->id;
        }

        $userUpdate = Auth::user();

        $inputs['user_update'] = $userUpdate->id;

        $user = User::findOrFail($userUpdate->id);

        $checkUserUpdate = $user->update($inputs);

        if ($checkUserUpdate)
            Session::flash('updated_user', 'The user has been updated.');


        return redirect('admin');
    }

}
