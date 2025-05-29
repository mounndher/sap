<?php

namespace App\Providers;

use App\Models\settingsLdap;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class LdapConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {

    }



      public function boot(): void
{
    $settings = settingsLdap::first();

    if ($settings) {
        Config::set('ldap.connections.default', [
            'hosts' => [$settings->LDAP_HOST],
            'port' => (int)$settings->LDAP_PORT,
            'base_dn' => $settings->LDAP_BASE_DN,
            'username' => $settings->LDAP_USERNAME,
            'password' => $settings->LDAP_PASSWORD,
            'timeout' => (int)$settings->LDAP_TIMEOUT,
            'use_ssl' => filter_var($settings->LDAP_USE_SSL, FILTER_VALIDATE_BOOLEAN),
            'use_tls' => filter_var($settings->LDAP_USE_TLS, FILTER_VALIDATE_BOOLEAN),
        ]);

        Config::set('ldap.default', $settings->LDAP_CONNECTION);
    }
}

}
