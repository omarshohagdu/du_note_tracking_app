<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ApiLogin extends Component
{
    public $email, $password;
    public $errorMessage;

    public function login()
    {

        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $response = Http::withHeaders([
                'secret-key' => '4a4cfb4a97000af785115cc9b53c313111e51d9a',
            ])->post('https://ssl.du.ac.bd/api/login', [
                'email' => $this->email,
                'password' => $this->password,
            ]);


            if ($response->successful()) {
                $data = $response->json();
              //  dd($data);
                // Store token or user info in session
                Session::put('api_token', $data['access_token']);
                Session::put('user', $data['user']);

                // Optional: If you have a local User model you want to sync:
                // Auth::login($user);

                return redirect()->route('dashboard');
            } else {
                $this->errorMessage = 'Invalid credentials or login failed.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'Error: ' . $e->getMessage();
        }
    }

    public function render()
    {

        return view('livewire.auth.api-login');
    }
}

