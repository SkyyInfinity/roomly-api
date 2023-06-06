<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

class AdminController extends Controller
{
    private $authController;

    public function __construct() 
    {
        $this->authController = new AuthController;
    }
    public function index()
    {
        if(!$this->authController->isLoggedIn()) {

            // redirect to login page
            return redirect()->route('admin.login');;
        }

        return view('admin.admin');
    }

    public function login()
    {

        return view('admin.login');
    }

    public function getAllUsers()
    {
        // if(!$this->authController->isLoggedIn()) {

        //     // redirect to login page
        //     return redirect()->route('admin.login');;
        // }
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function getSingleUser($id)
    {
        // if(!$this->authController->isLoggedIn()) {

        //     // redirect to login page
        //     return redirect()->route('admin.login');;
        // }
        $user = User::find($id);

        return view('admin.users.single', compact('user'));
    }

    public function editSingleUser(Request $request, $id)
    {
        // if(!$this->authController->isLoggedIn()) {

        //     // redirect to login page
        //     return redirect()->route('admin.login');;
        // }
        $user = User::find($id);

        $user->update([
            'first_name' => ucfirst($request->first_name),
            'last_name' => ucfirst($request->last_name),
            'email' => $request->email
        ]);

        return redirect()->route('admin.users.index');
    }

    public function deleteSingleUser($id)
    {
        // if(!$this->authController->isLoggedIn()) {

        //     // redirect to login page
        //     return redirect()->route('admin.login');;
        // }
        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
