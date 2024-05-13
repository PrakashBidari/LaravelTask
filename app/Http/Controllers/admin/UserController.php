<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(10);
        return view('backend.user.index', compact('users'));
    }

    public function edit(User $user){
        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request,User $user){
        $data = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required'],
            'password' => ['sometimes', 'required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update($data);

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function destroy($id){

        try{
            $user = User::find($id);
            $user->delete();
            return back()->with('success',"Blog Deleated");
        }catch(\Throwable $th){
            return back()->with('error', $th);
        }
    }
}
