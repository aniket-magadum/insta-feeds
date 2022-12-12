<?php

namespace AniketMagadum\InstaFeeds\Commands;

use Illuminate\Console\Command;
use Http;

class RefreshInstaFeedsToken extends Command
{
    protected $name = "Refresh Insta Feeds Access Token";

    protected $description = "This command refreshes the access token at the set interval";

    protected $signature = "insta-feeds:refresh-token";

    public function handle()
    {
        $new_access_token = Http::get("https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&client_secret=" . $this->laravel['config']['insta_feeds']['client_secret'] . "&access_token=" . $this->laravel['config']['insta_feeds']['access_token'])
            ->json()['access_token'];
        
        if (! $this->writeNewEnvironmentFileWith($new_access_token)) {
            return false;
        }
    }


    protected function writeNewEnvironmentFileWith($key)
    {
        $replaced = preg_replace(
            $this->keyReplacementPattern(),
            'INSTA_FEEDS_ACCESS_TOKEN='.$key,
            $input = file_get_contents($this->laravel->environmentFilePath())
        );

        if ($replaced === $input || $replaced === null) {
            $this->error('Unable to set update refresh token key. No INSTA_FEEDS_ACCESS_TOKEN variable was found in the .env file.');

            return false;
        }

        file_put_contents($this->laravel->environmentFilePath(), $replaced);

        $this->output->success("Insta Feed Access Token has been refreshed");

        return true;
    }

    /**
     * Get a regex pattern that will match env APP_KEY with any random key.
     *
     * @return string
     */
    protected function keyReplacementPattern()
    {
        $escaped = preg_quote('='.$this->laravel['config']['insta_feeds']['access_token'], '/');

        return "/^INSTA_FEEDS_ACCESS_TOKEN{$escaped}/m";
    }
}