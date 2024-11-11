<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ResetPassword as AuthResetPassword;
use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public function AdminDashboard()
    {
        $user = User::selectRaw('count(id) as count, DATE_FORMAT(created_at, "%Y-%m") as month')->groupBy('month')->orderBy('month', 'asc')->get();
        $data['months'] = $user->pluck('month');
        $data['counts'] = $user->pluck('count');
        return view('admin.index', $data);
    }


    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function Admin_Profile()
    {
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('admin.admin_profile', $data);
    }

    public function admin_profile_update(Request $request)
    {
        $user = $request->validate([
            'email' => 'required|unique:users,email,' . Auth::user()->id
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        //   $user->password = $request->password;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if (!empty($request->file('photo'))) {

            $oldPhotoPath = 'upload/' . $user->photo;

            // Delete the old photo if it exists
            if (!empty($user->photo) && file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }

            $file = $request->file('photo');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $filename);
            $user->photo = $filename;
        }
        //   $user->profile = $request->profile;
        $user->address = $request->address;
        $user->about = $request->about;
        $user->website = $request->website;
        $user->save();

        return redirect('admin/profile')->with('success', 'Profile Update Successfuly');
    }


    public function AdminUser(Request $request)
    {

        $data['getRecords'] = User::getRecord($request);
        $data['TotalAdmin'] = User::where('role', '=', 'admin')->count();
        $data['TotalAgent'] = User::where('role', '=', 'agent')->count();
        $data['TotalUser'] = User::where('role', '=', 'User')->count();
        $data['TotalActive'] = User::where('status', '=', 'active')->count();
        $data['TotalInactive'] = User::where('status', '=', 'inactive')->count();
        $data['Total'] = User::count();
        return view('admin.users.list', $data);
    }

    public function admin_user_view($id)
    {
        $data['getRecord'] = User::find($id);

        return view('admin.users.view', $data);
    }
    public function AdminUser_add()
    {
        return view('admin.users.add');
    }
    public function AdminUser_add_store(Request $request)
    {
        // dd($request->all());
        $save = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'role' => 'required',
            'status' => 'required',
        ]);

        $user = new User();
        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->email = trim($request->email);
        $user->phone = trim($request->phone);
        $user->role = trim($request->role);
        $user->status = trim($request->status);
        $user->remember_token = Str::random(50);
        $user->save();

        Mail::to($user->email)->send(new RegisterMail($user));

        return redirect('admin/user')->with('success', 'Record Successfuly Create');
    }

    public function AdminUser_edit($id)
    {
        $data['user'] = User::find($id);
        return view('admin.users.edit', $data);
    }
    public function AdminUser_update($id, Request $request)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone  = $request->phone;
        $user->role  = $request->role;
        $user->status  = $request->status;
        $user->save();

        return redirect('admin/user')->with('success', 'User Updated Successfuly');
    }
    public function AdminUser_delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('admin/user')->with('success', 'User Delete Successfuly');
    }



    public function set_new_password($token, Request $request)
    {
        $data['token'] = $token;
        return view('auth.reset_pass', $data);
    }
    public function set_new_password_post($token, Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('remember_token', $token)->first();

        if (!$user) {
            // Temporary debug message
            return redirect()->back()->with('error', 'Invalid or expired token.');
        }

        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50); // Reset token after password change
        $user->save();

        return redirect()->route('admin.login')->with('success', 'New Password has been set successfully.');
    }

    public function AdminUser_updated(Request $request)
    {
      $recoder = User::find($request->input('edit_id'));
      $recoder->name = $request->input('edit_name');
      $recoder->save();
      $json['success'] ='Data Updated Success';
      echo json_encode($json);
    }
    public function AdminUser_ChangeStatus(Request $request)
    {
        // Retrieve the user using the order_id
        $user = User::find($request->order_id);
        
        // Check if user exists before proceeding
        if ($user) {
            // Update the status field with status_id
            $user->status = $request->status_id;
            
            // Save the updated user record
            $user->save();
            
            // Return a JSON response with success
            return response()->json(['success' => true]);
        } else {
            // If no user found, return error response
            return response()->json(['success' => false, 'message' => 'User not found']);
        }
    }

    public function admin_myprofile(){
        $data['user'] = User::find(Auth::user()->id);
       return view('admin/profile' , $data);
    }
    
}
