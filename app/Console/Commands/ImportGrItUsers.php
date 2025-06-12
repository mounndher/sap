<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LdapRecord\Models\ActiveDirectory\Group;
use App\Models\User;

class ImportGrItUsers extends Command
{
    protected $signature = 'ldap:import-grit';
    protected $description = 'Import LDAP users from gr-IT group into the users table';

    public function handle()
    {
        $group = Group::where('cn', '=', 'gr-IT')->first();

        if (!$group) {
            $this->error("Group 'gr-IT' not found.");
            return 1;
        }

        $members = $group->members()->get();
        $this->info("Found {$members->count()} members in group gr-IT");

        foreach ($members as $ldapUser) {
            $username = strtolower(trim($ldapUser->getFirstAttribute('samaccountname')));
            $name = trim($ldapUser->getFirstAttribute('cn'));

            // Validate required fields
            if (empty($username)) {
                $this->warn("Skipped user with missing username.");
                continue;
            }

            if (empty($name)) {
                $this->warn("Skipped user '{$username}' due to missing full name (cn).");
                continue;
            }

            // Create or update the user
            User::updateOrCreate(
                ['username' => $username],
                [
                    'name' => $name,
                    'password' => bcrypt('password') // temporary password
                ]
            );

            $this->line("Imported: {$name} ({$username})");
        }

        $this->info("Import completed.");
        return 0;
    }
}
