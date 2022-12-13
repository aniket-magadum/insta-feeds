# Insta Feeds

> Display Instagram Posts on your website with ease. 

This addon make's use of the [Instagram Page Display API](https://developers.facebook.com/docs/instagram-basic-display-api/) for fetching data via Instagram. 

## Features

- Provides you a tag which you use to render instagram posts in your template.
- Refresh the access token via schedular so you always keep fetching the latest content.
- Caching of the API response for faster rendering.


## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require aniket-magadum/insta-feeds
```

## How to Use

Once the extension is installed we have to setup the ```INSTA_FEEDS_ACCESS_TOKEN``` and ```INSTA_FEEDS_CLIENT_SECRET``` in your .env file.


