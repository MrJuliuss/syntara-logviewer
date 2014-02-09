# Syntara Logviewer (Laravel 4 package)

<br>
A Logviewer for [Syntara package](https://github.com/MrJuliuss/syntara), using [Mikemand logviewer package](https://github.com/mikemand/logviewer)


<img src="https://raw.github.com/MrJuliuss/syntara-logviewer/master/screenshots/logviewer.png" />

## Features

* Views and delete Laravel4 logs

## Requirements
* PHP 5.3+


## Dependencies

* [Syntara admin package 1.1.8+](https://github.com/MrJuliuss/syntara)
* [Mikemand logviewer package](https://github.com/mikemand/logviewer)

## Installation


In the require key of composer.json file add the following line

If your application uses **Laravel 4.0** :

```"mrjuliuss/syntara-logviewer": "1.0.*"```

If your application uses **Laravel 4.1** :

```"mrjuliuss/syntara-logviewer": "1.1.*"```

Run the Composer update command

```$ composer update```

In **app/config/app.php** :

Add  ``` 'Kmd\Logviewer\LogviewerServiceProvider'``` and  ```'Mrjuliuss\SyntaraLogviewer\SyntaraLogviewerServiceProvider'``` to the end of the $providers array

    'providers' => array(
        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        ...
        'Kmd\Logviewer\LogviewerServiceProvider',
        'Mrjuliuss\SyntaraLogviewer\SyntaraLogviewerServiceProvider'
    ),

Launch install commands :

```php artisan logviewer:install```

You can see logs here :

http://your-url/dashboard/logviewer

## Custom Development

### Add logviewer to the navbar

- If you already have a template for navigation : 
-> add to your template

@include('syntara-logviewer::navigation')

- else : 

add to app/filters.php (or app/routes.php)

    View::composer('syntara::layouts.dashboard.master', function($view)
    {
        $view->nest('navPages', 'syntara-logviewer::navigation');
    });

---------

###A note about Laravel 4.1 ([mikemand](https://github.com/mikemand/logviewer) recommandation)

As of right now (2013-11-29), fresh Laravel 4.1 applications log things differently than they used to. While this doesn't *technically* break LogViewer, LogViewer also doesn't know how to handle these changes. Whether these changes are permanent or not is unclear, but here's a quick fix:

In your `app/start/global.php`, [line 34](https://github.com/laravel/laravel/blob/develop/app/start/global.php#L34) change:

```php
Log::useFiles(storage_path().'/logs/laravel.log');
```

to:

```php
$logFile = 'log-'.php_sapi_name().'.txt';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);
```

This only applies to new installations of Laravel 4.1. If you've upgraded an existing 4.0 application (and did not make changes to the way logs are created and stored), everything should still work.

---------

### Others : 

Please see [Mikemand logviewer doc](https://github.com/mikemand/logviewer).

## License

Syntara logviewer is released under the MIT License. See the licence file for details.
