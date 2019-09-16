<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Validator;
use Mail;
use Illuminate\Support\Str;
class UsersController extends Controller
{
    /**
     * Admin login section
     * @method adminLogin
     * @param null
     */
    public function adminLogin()
    {
        return view('admin.pages.login');
    }

    /**
     * Authenticate user 
     * @method authenticate
     * @param null
     */
    public function authenticate(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        //print_r(bcrypt($request->password));exit;
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            Session::put('admin', Auth::User()->id);
            return redirect()->intended('admin/index');
        }
        else{
            Auth::logout();
            return redirect()->intended('admin-login')->with('error','Invalide username or password');

        }
    }

    /**
     * Logout
     * @method logout
     * @param null
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->intended('admin-login'); 
    }
    /**
     * Update Profile Page
     * @method profile
     * @param null
     */
    public function profile(Request $request)
    {
        $id =  $request->session()->get('admin');
        $detail = User::find($id)->first();
        return view('admin.pages.profile',compact('detail'));
    }
    /**
     * Update User profile via ajax in custom.js file
     * @method updateProfile
     * @param null
     */
    public function updateProfile(Request  $request)
    {
        $validator = Validator::make($request->all(),[
            'email'    => 'required',
            'name'     => 'required',
            'password' => 'confirmed',
            'profile_img' => 'image'
        ]);
       
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()]);
        }
        else{
            $id =  $request->session()->get('admin');
            $detail = User::find($id);
            $data = array_filter($request->all());
            $data['password'] = $request->password != '' ? bcrypt($request->password):''; 
            
            $image ='';
            $image_file = $request->file('profile_img');
            if(!empty($image_file)){
            $image = 'admin'.rand(1,999).'.'.$image_file->getClientOriginalExtension();
            $image_file->move('./uploads',$image);
            }
            $data = array_filter($request->except('_token','password_confirmation'));
            
            $data['profile_img']= $image != '' ? $image : $detail['profile_img'] ;
            
            User::where('id',$id)->update(array_filter($data));

            return response()->json(['success'=>'Profile update sucessful','status' =>200,'action' =>'active']);
        }
        
    }
    /**
     * forgot password 
     * @method forgot
     * @param null
     */
        public function forgotPassword(Request  $request)
        {  
            if ($request->isMethod('post')) {
                $validatedData = $request->validate([
                'email' => 'required',
            ]);
            $rand = Str::random(6);
           
            if (User::where('email', $request->email)->exists()) {
                Mail::raw('OTP for Recover your account  is '.$rand,  function($message ) use ($request)
                    {
                    $message->from('info@mgrowkids.com', 'GROW KIDS');
                    $message->subject('OTP');
                    $message->to($request->email);
                    });
                    User::where('email',$request->email)->update(array('remember_token'=>$rand));
                    
                    return redirect()->intended('recover/password')->with('success','OTP sent sucessfully');
                
             }else{
                return redirect()->intended('forgot/password')->with('error','Invalide username or password');
                
             }
            }
           return view('admin.pages.forgot_password');

        }
        /**
         * Recover Password
         * @method recoverPassword
         * @param null
         */
        public function recoverPassword(Request $request)
        {
            if ($request->isMethod('post')) {
                $validatedData = $request->validate([
                'otp' => 'required',
                'password' => 'required|confirmed'
            ]);
            User::where('remember_token',$request->otp)->update(array('password' => bcrypt($request->password),'remember_token' => ''));
            return redirect()->intended('admin-login')->with('success','Password has been change'); 
        }
            return view('admin.pages.recover_password');
        }
}
