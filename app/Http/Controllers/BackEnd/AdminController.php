<?php

namespace App\Http\Controllers\BackEnd;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('backend.admin.dashboard.index');
    }

    public function AdminLogin()
    {
        return view('backend.admin.auth.admin_login');
    }
    public function AdminProfile()
    {
        $loggedUserId = Auth::user()->id;
        $loggedUser = User::where('id',$loggedUserId)->first();
        return view('backend.admin.profile.index',compact('loggedUser'));
    }

    public function AdminProfileStore(Request $request)
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
   //dd($tmp_file->file);
        if($tmp_file){
           //copy new temp file
           File::copy(public_path('upload/tmp/admin_images/'.$tmp_file->file), public_path('upload/admin_images/'.$tmp_file->file));
           //delete old file
           @unlink(public_path('upload/admin_images/'.$old_file));
            $loggedUser->name = $request->name;
            $loggedUser->username = $request->username;
            $loggedUser->email =  $request->email;
            $loggedUser->phone = $request->phone;
            $loggedUser->address =  $request->address;
            $loggedUser->photo = $tmp_file->file;
            $loggedUser->save();

            //Storage::deleteDirectory(public_path('upload/tmp/admin_images'));
            //delete new temp file
            @unlink(public_path('upload/tmp/admin_images/'.$tmp_file->file));
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


    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function ChangePassword()
    {
        return view('backend.admin.auth.change_password');
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
            $originalFileName =  $image->getClientOriginalName();
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $fileName =  $timestamp .$originalFileName;
            $pathToUpload = public_path('upload/tmp/admin_images/');  // image  upload application save korbo

      
        if(!is_dir($pathToUpload)) {

            mkdir($pathToUpload, 0755, true);
            mkdir(public_path('upload/admin_images'), 0755, true);

        }

        $image->move( $pathToUpload,$fileName);
        
         TemporaryFile::create([
            'user_id' =>  Auth::user()->id,
          'folder' => $pathToUpload,
          'file' =>  $fileName,
         ]);

            return  $fileName;
     
    }

    public function TempRemove()
    {
        $tmp_file = TemporaryFile::where('file', request()->getContent())->first();
        // dd($tmp_file);
        if($tmp_file)
        {
            @unlink(public_path('upload/tmp/admin_images/'.$tmp_file->file));
            $tmp_file->delete();
            return response('');
        }
    }

        private function uploadImage($file, $title)
    {
        
        //dd($file);
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

        $file_name = $timestamp .'-'.$title. '.' . $file->getClientOriginalExtension();
        

        $pathToUpload = public_path('upload/admin_images/');  // image  upload application save korbo
        
      // dd($pathToUpload);
      
        if(!is_dir($pathToUpload)) {

            mkdir($pathToUpload, 0755, true);

        }

        $file->move( $pathToUpload,$file_name);
        
      //Image::make($file)->resize(634,792)->save($pathToUpload.$file_name);
      
        return $file_name;
    }

        private function unlink($file)
    {
       // dd($file);
        $pathToUpload =  public_path('upload/admin_images/'); 
                                                                                                                  //dd( $pathToUpload.$file); //"D:\Lara Practice\Project 1 lara 8\protfolio_lara8\storage/app/public/upload/admin_images/2022-12-05-15-12-33-Prohor.jpg"
       // dd(file_exists($pathToUpload.$file));

        if ($file != '' && file_exists($pathToUpload.$file)) {
            
            @unlink($pathToUpload.$file);
        }

    }
}
