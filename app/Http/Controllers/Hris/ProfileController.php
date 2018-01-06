<?php
namespace App\Http\Controllers\Hris;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdatePassword;
use App\Http\Controllers\Controller;
use App\Models\Administrator 		as A;
use App\User 		as U;
use Illuminate\Support\Facades\File;
use Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $id = Auth::id();
    	$lvl = Auth::user()->level;
    	if($lvl==1)
	    	$data = A::where('login', $id)->first();
	    // else if($lvl==2)
	    // 	$tbl = M::where('login', $id)->first();
	    // else
	    // 	$tbl = Cs::where('login', $id)->first();
        $username = Auth::user()->username;
        $oper = array(
            'title'         => 'Change Profile'.title(),
            'modul'         => 'profile',
            'data'          => $data,
            'username'      => $username,
            'action'        => route('profile.update'),
            'profile'       => $this->profile()
        );
        return view('profiles.edit', $oper);
    }

    public function update(Request $request)
    {
        $rules = [
            'name'          => 'required',
            'username'      => 'required|min:6'
        ];

        $usernameIsChange = $request->username!=$request->old_username;

        if($usernameIsChange)
            $rules['username']='required|min:6|unique:users';

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if($usernameIsChange)
            U::where(['username'=>$request->old_username])
                ->update([
                    'username'  => $request->username
            ]);

        $lvl = Auth::user()->level;
        $id = Auth::id();
    	if($lvl==1)
            $tbl = A::where('login', $id);
        else if($lvl==2)
            $tbl = M::where('login', $id);
        else
            $tbl = Cs::where('login', $id);

        $tbl->update([
            'name'              => $request->name,
            'gender'            => $request->gender,
            'born_in'           => upper($request->born_in),
            'birthdate'         => eng_date($request->birthdate),
            'address'           => $request->address
        ]);

        parent::create_activity('Edit Profile');

        return redirect()->route('/')->with('success', 'Profil has been updated');
    }

    public function avatarupdate(Request $r)
    {
    	$avatar = $r->file('avatar');
        $this->validate($r, [
            'avatar'        => 'mimes:jpeg,png|dimensions:min_width=150,max_width=512,min_height=150,max_height=512|max:300'
        ]);

        File::delete(public_path('storage/'.Auth::user()->avatar));
    	$path = $avatar->storeAs('avatars', date('HiYsmdmdi').'.'.$avatar->getClientOriginalExtension());
        U::where('id', Auth::id())->update(['avatar_path'=>$path]);
        create_activity('Change avatar');
    	return 'Avatar has been updated';
    }

    public function passwordupdate(Request $r)
    {
    	$rules = [
            'password'      => 'required|min:6|confirmed'
        ];
    	$this->validate($r, $rules);
    	U::where('id', Auth::id())->update(['password'=>$r->password]);
        parent::create_activity('Update Password');
    	return redirect()->route('/')->with('success', 'Password has been updated');
    }

    public function reset()
    {
    	U::where('id', Auth::id())->update(['password'=>bcrypt(Auth::user()->username)]);
        parent::create_activity('Reset Password');
    	return redirect()->route('/')->with('success', 'Password has beend reset');
    }

    public function detail()
    {
        return view('profiles.detail');
    }

    public function avatarLeftbar()
    {
        return view('avatar_leftbar', [

        ]);
    }

    public function avatarImage()
    {
        return active_avatar();
    }
}
