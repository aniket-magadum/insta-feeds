<?php

namespace AniketMagadum\InstaFeeds;

use AniketMagadum\InstaFeeds\Commands\FetchInstaFeeds;
use AniketMagadum\InstaFeeds\Commands\RefreshInstaFeedsToken;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        Tags\InstaFeed::class,
    ];

    protected $commands = [
        FetchInstaFeeds::class,
        RefreshInstaFeedsToken::class
    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/insta_feeds.php', 'insta_feeds');
    }

    public function bootAddon()
    {
        
    }
}
