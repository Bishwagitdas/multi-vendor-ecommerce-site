<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function VendorDashboard()
    {
        return view('backend.vendor.dashboard.index');
    }

    public function VendorLogin()
    {
        return view('backend.vendor.auth.vendor_login');
    }

    public function VendorProfile()
    {
        $loggedUserId = Auth::user()->id;
        $loggedUser = User::where('id',$loggedUserId)->first();
        return view('backend.vendor.profile.index',compact('loggedUser'));
    }

    public function VendorProfileStore(Request $request)
    {
        
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $tmp_file = TemporaryFile::where('user_id',Auth::user()->id)->first();
        $old_file = Auth::user()->photo;
       // dd( $tmp_file->file);
       $loggedUserId = Auth::user()->id;
       $loggedUser = User::where('id',$loggedUserId)->first();

       $notification = array(
            'message' => '<strong>Great Job!  '. $loggedUser->name.' </strong> <p>Profile Update Success</p>',
            'alert-type' => 'success'
        );

        if($tmp_file){
           //copy new temp file
           File::copy(public_path('upload/tmp/vendor_images/'.$tmp_file->file), public_path('upload/vendor_images/'.$tmp_file->file));
           //delete old file
           @unlink(public_path('upload/vendor_images/'.$old_file));
            $loggedUser->name = $request->name;
            $loggedUser->username = $request->username;
            $loggedUser->email =  $request->email;
            $loggedUser->phone = $request->phone;
            $loggedUser->address =  $request->address;
            $loggedUser->photo = $tmp_file->file;
            $loggedUser->save();

            //delete new temp file
            @unlink(public_path('upload/tmp/vendor_images/'.$tmp_file->file));
            $tmp_file->delete();

            return redirect()->back()->with($notification);

        }
        else
        {
            $loggedUser->name = $request->name;
            $loggedUser->username = $request->username;
            $loggedUser->email =  $request->email;
            $loggedUser->phone = $request->phone;
            $loggedUser->address =  $request->address;
            $loggedUser->save();
            return redirect()->back()->with($notification);
        }

    }


    public function VendorLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('vendor.login');
    }

    public function ChangePassword()
    {
        return view('backend.vendor.auth.change_password');
    }

    public function SavePassword(Request $request)
    {
       //dd($request);
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
                return redirect()->back()->with($notification);
       }
    }


    public function TempUpload(Request $request)
    {
       
       // dd($request);

            $image = $request->file('photo');
            $fileName =  $image->getClientOriginalName();
            $pathToUpload = public_path('upload/tmp/vendor_images/');  // image  upload application save korbo

      
        if(!is_dir($pathToUpload)) {

            mkdir($pathToUpload, 0755, true);
            mkdir(public_path('upload/vendor_images'), 0755, true);

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

}
