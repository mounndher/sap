<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LdapRecord\Models\ActiveDirectory\Group;
use App\Models\User;

class ImportGrITUsers extends Command
{
    protected $signature = 'ldap:import-grit';
    protected $description = 'Import members of the gr-IT group from LDAP';

    public function handle()
    {
        $group = Group::where('cn', '=', 'gr-IT')->first();

        if (!$group) {
            $this->error('Group "gr-IT" not found.');
            return;
        }

        $members = $group->members()->get();

        foreach ($members as $ldapUser) {
            $username = $ldapUser->getFirstAttribute('samaccountname');
            $name = $ldapUser->getFirstAttribute('cn');
            $email = $ldapUser->getFirstAttribute('mail');
            $guid = $ldapUser->getConvertedGuid();

            if (!$username || !$name) {
                $this->warn("Skipped one user with missing username or name.");
                continue;
            }

            User::updateOrCreate(
                ['username' => $username],
                [
                    'name' => $name,
                    'email' => $email ?: $username . '@local.pharma',
                    'guid' => $guid,
                    'password' => bcrypt('default') // or null if using LDAP login
                ]
            );

            $this->info("Imported: $username ($name)");
        }

        $this->info('✔ All gr-IT group members imported.');
    }
}
