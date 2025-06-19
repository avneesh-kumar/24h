<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserPasswordUpdate extends Command
{
    protected $signature = 'user:password-update {email} {--password=}';
    protected $description = 'Update the password for an existing user';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->option('password') ?? $this->secret('New Password');

        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error('User not found.');
            return 1;
        }

        $user->password = Hash::make($password);
        $user->save();

        $this->info('Password updated successfully for: ' . $user->email);
        return 0;
    }
}
