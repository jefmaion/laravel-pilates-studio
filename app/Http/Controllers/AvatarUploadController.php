<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AvatarUploadController extends Controller
{

    protected $avatarPath = 'images/avatar';

    public function index(User $user) {

        return view('user.avatar', compact('user'));
    }

    public function store(Request $request, User $user)
    {
         
        $request->validate([
            'avatar' => 'required|image',
        ]);

        if($user->avatar) {
            if(file_exists(public_path($this->avatarPath .'/' . $user->avatar))) {
                unlink(public_path($this->avatarPath .'/' . $user->avatar));
            }
        }

        $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();

        $image = Image::make($request->avatar->path())->fit(600);

        if(!$image->save(public_path($this->avatarPath) . '/' . $avatarName, 100)) {
            return false;
        }

        $user->avatar = $avatarName;
        $user->save();
    
        return back()->with('success', 'Foto adicionada com sucesso');
 
    }
}
