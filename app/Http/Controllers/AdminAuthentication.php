<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\MailerService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthentication extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Generate and send OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $user->otp_code = $otp;
            $user->otp_expires_at = now()->addMinutes(10);
            $user->is_otp_verified = false;
            $user->save();

            // Send OTP email
            $mailerService = new MailerService;
            $emailBody = view('email.otp', [
                'otp' => $otp,
            ])->render();
            $emailResult = $mailerService->sendMail($user->email, $emailBody);

            if ($emailResult !== true) {
                notyf()
                    ->duration(2000)
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->dismissible(true)
                    ->error('Failed to send verification code. Please try again later.');

                return back()->withInput();
            }

            // Store email in session temporarily for OTP verification
            session(['pending_admin_email' => $user->email]);

            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->success('Verification code sent to your email!');

            return redirect()->route('admin.otp.verify.page', ['email' => $user->email]);
        } else {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('The provided credentials do not match our records.');

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
    }

    public function otpVerifyPage(Request $request)
    {
        $email = $request->query('email');
        
        if (!$email || session('pending_admin_email') !== $email) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Invalid verification request.');

            return redirect()->route('admin.login');
        }

        return view('admin.otp-verify', ['email' => $email]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|array|size:6',
        ]);

        $email = $request->input('email');
        $otpArray = $request->input('otp');
        $otpCode = implode('', $otpArray);

        // Verify session
        if (session('pending_admin_email') !== $email) {
            return redirect()->route('admin.login')->withErrors(['otp' => 'Invalid verification request.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('admin.login')->withErrors(['otp' => 'User not found.']);
        }

        // Check if OTP is expired
        if (!$user->otp_expires_at || now()->isAfter($user->otp_expires_at)) {
            return redirect()->back()->withErrors(['otp' => 'Verification code has expired. Please request a new one.']);
        }

        // Verify OTP code
        if ($user->otp_code !== $otpCode) {
            return redirect()->back()->withErrors(['otp' => 'Invalid verification code. Please try again.']);
        }

        // OTP verified successfully
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->is_otp_verified = true;
        $user->save();

        // Log the user in
        Auth::guard('admin')->login($user);
        session()->forget('pending_admin_email');

        notyf()
            ->duration(2000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Login successful!');

        return redirect()->intended('/admin/dashboard');
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // Verify session
        if (session('pending_admin_email') !== $email) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid verification request.'
            ], 403);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        // Generate new OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->is_otp_verified = false;
        $user->save();

        // Send OTP email
        $mailerService = new MailerService;
        $emailBody = view('email.otp', [
            'otp' => $otp,
        ])->render();
        $emailResult = $mailerService->sendMail($user->email, $emailBody);

        if ($emailResult !== true) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send verification code. Please try again later.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Verification code sent to your email.'
        ]);
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

}
