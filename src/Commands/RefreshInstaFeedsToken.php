<?php

namespace AniketMagadum\InstaFeeds\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use AniketMagadum\InstaFeeds\Exceptions\InstagramAccessTokenNotSet;

class RefreshInstaFeedsToken extends Command
{
    protected $name = "Insta Feeds Fetch";

    protected $description = "This command which fetch feeds from instagram and cache it for future use.";

    protected $signature = "insta-feeds:fetch";

    public function handle()
    {
        
    }
