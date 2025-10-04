<?php

namespace App\Http\Controllers;

use App\Models\CustomerInformation as CustomerInformationData;
use App\Services\MailerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerAuthentication extends Controller
{
    public function register()
    {

        return view('jinja.registration');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customer_information,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                notyf()
                    ->duration(2000)
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->dismissible(true)
                    ->error($error);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        // start transaction
        DB::beginTransaction();

        $hash_token = bin2hex(random_bytes(32)); // 64 characters

        $customer = CustomerInformationData::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'hash_token' => $hash_token,
        ]);

        // send email
        $mailerService = new MailerService;
        $emailBody = view('email.confirmation', [
            'name' => $customer->name,
            'verificationLink' => env('MYLINK').'/confirmation?email='.urlencode($customer->email).'&hashtoken='.$customer->hash_token,
        ])->render();
        $emailResult = $mailerService->sendMail($customer->email, $emailBody);

        if ($emailResult !== true) {
            DB::rollBack();
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Failed to send verification email. Please try again later.');

            return redirect()->back()->withInput();
        }

        DB::commit();
        notyf()
            ->duration(2000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Registration successful! Please check your email for verification.');

        return redirect()->back();
    }

    public function confirmEmail(Request $request)
    {
        $email = $request->query('email');
        $token = $request->query('hashtoken');

        $customer = CustomerInformationData::where('email', $email)
            ->where('hash_token', $token)
            ->first();

        if (! $customer) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Invalid verification link or user does not exist.');

            return redirect()->route('login');
        }

        if ($customer->is_verified) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->info('Your email is already verified. Please log in.');

            return redirect()->route('login');
        }

        $customer->email_verified_at = now();
        $customer->hash_token = null; // Invalidate the token after verification
        $customer->save();

        notyf()
            ->duration(2000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Email verified successfully! You can now log in.');

        return redirect()->route('login');
    }

    public function login()
    {
        return view('jinja.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                notyf()
                    ->duration(2000)
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->dismissible(true)
                    ->error($error);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer = CustomerInformationData::where('email', $credentials['email'])->first();

        if (! $customer || ! Hash::check($credentials['password'], $customer->password)) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Invalid email or password.');

            return redirect()->back()->withInput();
        }

        if (! $customer->email_verified_at) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->warning('Please verify your email before logging in.');

            return redirect()->back()->withInput();
        }

        if ($customer->status == 'banned') {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Your account has been banned. Remarks'.$customer->remarks.' Please contact support.');

            return redirect()->back()->withInput();
        }
        if ($customer->status == 'suspended') {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Your account has been suspended. Remarks:'.$customer->remarks.' Please contact support.');

            return redirect()->back()->withInput();
        }

        // Log the user in
        session(['customer_id' => $customer->id]);

        notyf()
            ->duration(2000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Login successful!');

        return redirect()->route('home');
    }

    public function updateProfile(Request $request)
    {
        $customerId = session('customer_id');

        if (! $customerId) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('You must be logged in to update your profile.');

            return response()->back()->withInput();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                notyf()
                    ->duration(2000)
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->dismissible(true)
                    ->error($error);
            }

            return response()->back()->withErrors($validator)->withInput();
        }

        $customer = CustomerInformationData::find($customerId);
        if (! $customer) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('User not found');

            return response()->back()->withInput();
        }

        $customer->name = $request->input('name');
        $customer->phone = $request->input('mobile');
        $customer->address = $request->input('address');
        $customer->save();

        notyf()
            ->duration(2000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Profile updated successfully!');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('customer_id');

        notyf()
            ->duration(2000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Logged out successfully!');

        return redirect()->route('login');
    }
    public function showLinkRequestForm()
    {
        return view('jinja.forgot');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $csi = CustomerInformationData::where('email', $request->email)->first();
        if (! $csi) {
            Notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Email does not exist in our records.');
            return redirect()->back()->withInput();
        }

        //generate the 8 character random password
        $password = bin2hex(random_bytes(4)); // 8 characters
        $mailerService = new MailerService;
        $emailBody = view('email.password', [
            'name' => $csi->name,
            'password' => $password,
        ])->render();

        $csi->password = Hash::make($password);
        $csi->save();

        $emailResult = $mailerService->sendMail($csi->email, $emailBody);

        notyf()
            ->duration(2000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('A new password has been sent to your email address.');

        return redirect()->route('login');
    }
}


