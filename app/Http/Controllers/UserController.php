<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserDashboard()
    {
       $loggedUser = User::whereId(Auth::user()->id)->first();
        return view('frontend.dashboard.index',compact('loggedUser'));
    }


    
    public function TempUpload(Request $request)
    {
       
       // dd($request);

            $image = $request->file('photo');
            $fileName =  $image->getClientOriginalName();
            $pathToUpload = public_path('upload/tmp/user_images/');  // image  upload application save korbo

      
        if(!is_dir($pathToUpload)) {

            mkdir($pathToUpload, 0755, true);
            mkdir(public_path('upload/user_images'), 0755, true);

        }

        $image->move( $pathToUpload,$fileName);
        
         TemporaryFile::create([
            'user_id' =>  Auth::user()->id,
          'folder' => $pathToUpload,
          'file' =>  $fileName,
         ]);

            return  $fileName;
     
    }

    public function TempRemove(Request $request)
    {
        if($request->hasFile('photo'))
        {
            
        }
    }
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => '<p>Logout Successful</p>',
            'alert-type' => 'success'
            );

        return redirect()->route('login')->with($notification);
    }
    public function SavePassword(Request $request)
    {
       $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|confirmed',
        'new_password_confirmation' => 'required',
       ]);

       if( Hash::check($request->old_password, Auth::user()->password))
       {
            
            User::whereId(Auth::user()->id)->update(
                [
                    'password' => Hash::make($request->new_password),
                ]);

            $notification = array(
                'message' => 'Password Updated Successfully',
                'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
       }
       else
       {
            $notification = array(
                'message' => '<p>Sorry! Update Unsuccessfull</p>',
                'alert-type' => 'error'
                );
                return redirect()->back()->with($notification)->with('error','Old password does not match');
       }
    }
}
