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

```"mrjuliuss/syntara-logviewer": "1.*"```

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

add to your template

```@include('syntara-logviewer::navigation')```

- else : 

add to app/filters.php (or app/routes.php)

    View::composer('syntara::layouts.dashboard.master', function($view)
    {
        $view->nest('navPages', 'syntara-logviewer::navigation');
    });

### Others : 

Please see [Mikemand logviewer doc](https://github.com/mikemand/logviewer).

## License

Syntara logviewer is released under the MIT License. See the licence file for details.
