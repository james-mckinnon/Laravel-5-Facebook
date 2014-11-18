Laravel 5 - Facebook SDK v4 wrapper
===============

<img src="https://poser.pugx.org/philo/laravel5-facebook/version.svg"> <img src="https://poser.pugx.org/philo/laravel5-facebook/downloads.svg">

## Installation
The package can be installed via Composer by requiring the "philo/laravel5-facebook": "1.0.*" package in your project's composer.json.

```
{
    "require": {
        "laravel/framework": "~5.0*",
        "philo/laravel5-facebook": "1.0.*"
    },
    "minimum-stability": "dev"
}
```

Next you need to add the service provider to app/config/app.php

```
'providers' => array(
    // ...
    'Philo\Laravel5Facebook\Laravel5FacebookServiceProvider',
)
```

And do the same for the alias:

```php
'aliases' => array(
	// ...
	'Facebook'  => 'Philo\Laravel5Facebook\Facades\Facebook',
)
```

## Add Facebook to services

Laravel 5 has a new file that contains all third party services (app/config/services.php).
Add your client_id and client_secret.

```php
<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'facebook' => [
		'client_id' => '1234567891234612',
		'client_secret' => 'a837f07gjsoxya721964120z7dkgr',
	],
];
```

## Usage

```php
// Create session
$token = '<facebook access token>';
Facebook::createSession($token);

// Request
$user = Facebook::request('/me')->getGraphObject(GraphUser::className());
```

I've added a couple shortcuts for the most common graph objects.

```php
$user = Facebook::user();
$location = Facebook::location();
$albums = Facebook::albums();
$album = Facebook::album(1234567890);
```

If you would like to access the FacebookSession object, call the `getSession` method.

```php
$session = Facebook::getSession();
$info = $session->getSessionInfo();
```
