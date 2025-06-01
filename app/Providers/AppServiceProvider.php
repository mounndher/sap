<?php

namespace App\Providers;
use App\Models\Mail_settings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{

    if ($mailSettings = Mail_settings::first()) {
        Config::set('mail.mailers.smtp.transport', 'smtp');
        Config::set('mail.mailers.smtp.host', $mailSettings->mail_host);
        Config::set('mail.mailers.smtp.port', $mailSettings->mail_port);
        Config::set('mail.mailers.smtp.encryption', $mailSettings->mail_encryption);
        Config::set('mail.mailers.smtp.username', $mailSettings->mail_username);
        Config::set('mail.mailers.smtp.password', $mailSettings->mail_password);
        Config::set('mail.from.address', $mailSettings->mail_from_address);
        Config::set('mail.from.name', $mailSettings->mail_from_name);
    }


}
}
