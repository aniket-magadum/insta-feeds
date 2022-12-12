<?php

namespace AniketMagadum\InstaFeeds\Tags;

use AniketMagadum\InstaFeeds\Commands\FetchInstaFeeds;
use Illuminate\Support\Facades\Cache;
use Statamic\Tags\Tags;

class InstaFeed extends Tags
{
    /**
     * The {{ insta_feed }} tag.
     *
     * @return string|array
     */

    public $isPair = true;

    public function index()
    {
        $feeds =  Cache::get("insta_feeds");
        
        if (!$feeds) {
            $feeds = FetchInstaFeeds::fetchAndCacheMedias();
        }

        $feeds = $feeds->take($this->params->get('limit') ?? 6)->values();

        return $feeds->toArray();
    }
}
