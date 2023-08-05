<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Google\Client as GoogleClient;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GoogleClient::class, function () {
            $client = new GoogleClient();
            $client->setApplicationName('Road Traffic Dataset'); // Set your application name
            $client->setClientId('337717579036-i59ktc3jtmr026af68uhi55ahfqkrvok.apps.googleusercontent.com');
            $client->setClientSecret('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');
            $client->setRedirectUri('http://localhost:8000/oauth2callback'); // Adjust the URI as needed
            $client->addScope('https://www.googleapis.com/auth/drive');

            return $client;
        });
    }
}
