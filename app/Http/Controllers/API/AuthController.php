<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

use Spatie\Permission\Models\Role;

class AuthController extends BaseController
{
    /**
     * Admin Register API
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name'       => 'required|string|max:50',
                'last_name'        => 'nullable',
                'phone_number'     => 'required',
                'email'            => 'required|string|email|max:50',
                'password'         => 'required|min:8|max:16',
                'confirm_password' => 'required|min:8|max:16|same:password',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $user = User::create($request->all());
            $user->assignRole(2);
            return $this->sendResponse($user, 'Your account has been created successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Super Admin Login API
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|exists:users',
                'password' => 'required|min:8|max:16'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $user->token = $user->createToken("API TOKEN")->plainTextToken;
                return $this->sendResponse($user, 'User login successfully.');
            } else {
                return $this->sendError('Unauthorised.', ['error' => 'Email and password you provided is incorrect.']);
            }
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * View user api
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $user = Auth()->user();
        return $this->sendResponse($user, 'Profile data get successfully');
    }

    /**
     * Update user api
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $user = Auth::user();
            $user->update($request->all());
            return $this->sendResponse($user, 'Your profile updated successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Change user password api
     *
     * @return \Illuminate\Http\Response
     */
    public function changePass(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:8|max:16',
                'confirm_password' => 'required|min:8|max:16|same:new_password'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $user = Auth::user();
            if (Hash::check($input['current_password'], $user->password)) {
                $input['password'] = $request->new_password;
                $user->update($input);
                return $this->sendResponse('', 'Your password changed successfully.');
            } else {
                return $this->sendError('Password Error.', 'Oops! current password is incorrect.');
            }
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Forgot user password api
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPass(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $otp = rand(100000, 999999);  // Generate a random 6-digit number.
            Mail::to($request->email)->send(new OTPMail($otp));
            $data = ['otp' => $otp, 'email' => $request->email];
            return $this->sendResponse($data, 'Reset password OTP send to given email successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Reset user password api
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPass(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'           => 'required|email|exists:users',
                'new_password'    => 'required|min:8|max:16',
                'confirm_password'=> 'required|min:8|max:16|same:new_password'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $user = User::where('email', $request->email)->first();
            $user->update(['password' => $request->new_password]);
            return $this->sendResponse('', 'Your password reset successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth()->user()->tokens()->delete();
        return $this->sendResponse('', 'You have successfully logout');
    }
}