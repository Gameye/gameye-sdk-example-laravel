![Gameye](https://gameye.com/img/logo_blue.png)

# Gameye example implementation in Laravel #

This an example implementation of the [Gameye PHP SDK](https://github.com/Gameye/gameye-sdk-php/) in Laravel.  
You can clone this project and see how you can integrate the Gameye API to create your own website or backend to start and managing game matches.

## Installation ##

Install the required packages via Composer

```cmd
composer install
```

Copy the env.example file to a new .env file and Make sure to add your [Steam Web API key](http://steamcommunity.com/dev/apikey)

```cmd
cp .env.example .env
```

Generate a Laravel application key

```cmd
php artisan key:generate
```

## Creating a match ## 

Go to your project url and fill in your Gameye API key. Update your configuration and click on the first menu item to create your first CS:GO match.

## Support ##
Contact: [gameye.com](https://gameye.com) — support@gameye.com
