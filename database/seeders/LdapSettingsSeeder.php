<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LdapSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('settings_ldaps')->insert([
            'LDAP_CONNECTION' => 'default',
            'LDAP_HOST' => '10.20.30.5',
            'LDAP_PORT' => 389,
            'LDAP_BASE_DN' => 'DC=local,DC=pharma',
            'LDAP_USERNAME' => 'CN=glpi,OU=IT,OU=Users,OU=PharmaInvest Production,DC=local,DC=pharma',
            'LDAP_PASSWORD' => 'pharma@2025',
            'LDAP_USE_SSL' => 'false',
            'LDAP_USE_TLS' => 'false',
            'LDAP_TIMEOUT' => 5,
            'LDAP_LOGGING' => 'true',
        ]);
    }
}
