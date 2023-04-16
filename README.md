# Insta Feeds

> Display Instagram Posts on your website with ease. Use Coupon Code `FIRST10` for 50% discount for first 10 users only.

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

> Remember! This is a paid addon so purchase a license before using it. 

## How to Use

Once the extension is installed we have to setup the ```INSTA_FEEDS_ACCESS_TOKEN``` and ```INSTA_FEEDS_CLIENT_SECRET``` in your .env file.

```bash
INSTA_FEEDS_ACCESS_TOKEN=ACCESS_TOKEN_HERE
INSTA_FEEDS_CLIENT_SECRET=CLIENT_SECRET_HERE
```

In order to generate these tokens you can visit this [Get Started Guide for Instagram Basic Display API](https://developers.facebook.com/docs/instagram-basic-display-api/getting-started)

On the same page you have to create a long lived access token as below 

<img width="993" alt="image" src="https://user-images.githubusercontent.com/48653948/207324017-66f5a955-d5dc-4d50-aa6d-3a2a239c1085.png">

Once you click on generate token button it will ask your instagram details and once done you will receive this access token.

<img width="727" alt="image" src="https://user-images.githubusercontent.com/48653948/207324126-2d94115e-d3c1-4f71-9f68-ca18ac37ed06.png">

### Schedular

This addon requires the schedular to be running as it performs the following tasks to be run in the background.

- Caching of instagram posts for faster retrieval.
- Refreshing of the access token periodically so that we dont need to put in any manual efforts.

You can setup a schedular is not already running by [Following the Laravel Documenation](https://laravel.com/docs/9.x/scheduling#running-the-scheduler)

As of now, 

- Posts are cached every hour. 
- Token is refreshed every month.

If you wish to customize these values please let me know. But believe me the defaults are the best.

### Rendering the feeds

In order to render the feeds on the frontend we can make use of the ```{{ insta_feed }}``` tag . Here is an example snipped which you can use. We have also added a {{ nocache tag }} as it will prevent frontend caching of the page and make this template dynamic.

```html
{{ nocache }} 
  {{ insta_feed limit="8"}}
    <div class="mx-auto" style="margin-top: 30px;border: 2px solid black;">
       <img src="{{ media_url }}" alt="{{ caption }}" style="height: 300px ;width: 300px;">
       <p class="text-center"> {{ caption ?? 'No Caption Needed' }}</p>
    </div>
  {{ /insta_feed }}
{{ /nocache }}
```












