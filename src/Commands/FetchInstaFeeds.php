<?php

namespace AniketMagadum\InstaFeeds\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use AniketMagadum\InstaFeeds\Exceptions\InstagramAccessTokenNotSet;

class FetchInstaFeeds extends Command
{
    protected $name = "Insta Feeds Fetch";

    protected $description = "This command which fetch feeds from instagram and cache it for future use.";

    protected $signature = "insta-feeds:fetch";

    public function handle()
    {
        $medias = $this::fetchAndCacheMedias();

        $this->info("Insta feed has cached ".$medias->count()." medias");
    }

    public static function fetchAndCacheMedias()
    {
        $medias = self::medias();

        Cache::put('insta_feeds', $medias, now()->addDay());

        return $medias;
    }

    public static function medias()
    {
        $access_token = config("insta_feeds.access_token");

        if (!$access_token) {
            throw new InstagramAccessTokenNotSet("Instagram access token is not set");
        }

        $medias = collect(Http::get("https://graph.instagram.com/me/media?fields=
                id,username,media_type,caption,permalink,thumbmail_url,timestamp,media_url&access_token=" . $access_token)
            ->json()['data']);

        $medias = $medias->filter(
            function ($media) {
                return $media['media_type'] == "IMAGE";
            }
        )->values();

        return $medias;
    }
}