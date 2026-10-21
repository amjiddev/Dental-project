<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ShowUsersCommand extends Command
{
    protected $signature = 'users:show';
    protected $description = 'Display all users with their roles';

    public function handle()
    {
        $users = User::with('roles')->get();

        $this->info('=== Users and Roles ===');
        $this->newLine();

        foreach ($users as $user) {
            $roles = $user->getRoleNames()->join(', ') ?: 'No roles assigned';
            $this->line("📧 Email: {$user->email}");
            $this->line("👤 Name: {$user->name}");
            $this->line("🔑 Roles: {$roles}");
            $this->newLine();
        }

        return 0;
    }
}
