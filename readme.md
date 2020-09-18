# Laravel FCM
A simple package that help you send a Firebase notification with your Laravel applications

### Installation

You can pull the package via composer :

```bash
$ composer require rendyfutsuy/my-fcm
```

#### Laravel

You must register the service provider :

```php
// config/app.php

'Providers' => [
   // ...
   Angga\Fcm\FcmServiceProvider::class,
]
```

If you want to make use of the facade you must install it as well :

```php
// config/app.php

'aliases' => [
    // ...
    'Fcm' => Angga\Fcm\FcmFacade::class,
];
```

Next, You must publish the config file to define your FCM server key :

```bash
php artisan vendor:publish --provider="Angga\Fcm\FcmServiceProvider"
```

This is the contents of the published file :

```php
return [

    /**
     * Set your FCM Server Key
     * Change to yours
     */

    'server_key' => env('FCM_SERVER_KEY', ''),

];
```

#### Lumen

Add the following service provider to the `bootstrap/app.php` file
```php
$app->register(Angga\Fcm\FcmServiceProvider::class);
```

Also copy the [my-fcm.php](https://github.com/futsuy/my-fcm/blob/master/resources/config/my-fcm.php) config file to `config/my-fcm.php`


Add the configuration to the `bootstrap/app.php` file
    *Important:* this needs to be before the registration of the service provider
```php
$app->configure('my-fcm');
...
$app->register(Angga\Fcm\FcmServiceProvider::class);
```

Set your FCM Server Key in `.env` file :

```
APP_NAME="Laravel"
# ...
FCM_SERVER_KEY=putYourKeyHere
```

### Usage

If You want to send a FCM with just notification parameter, this is an example of usage sending a FCM with only data parameter :

```php
$recipients = [
    'clKMv.......',
    'GxQQW.......',
];

fcm()
    ->to($recipients)
    ->priority('high')
    ->timeToLive(0)
    ->data([
        'title' => 'Test FCM',
        'body' => 'This is a test of FCM',
    ])
    ->send();
```

If You want to send a FCM to topic, use method toTopic(\$topic) instead to() :

```php
fcm()
    ->toTopic($topic) // $topic must an string (topic name)
    ->priority('normal')
    ->timeToLive(0)
    ->notification([
        'title' => 'Test FCM',
        'body' => 'This is a test of FCM',
    ])
    ->send();
```

If You want to send a FCM with just notification parameter, this is an example of usage sending a FCM with only notification parameter :

```php
fcm()
    ->to($recipients) // $recipients must an array
    ->priority('high')
    ->timeToLive(0)
    ->notification([
        'title' => 'Test FCM',
        'body' => 'This is a test of FCM',
    ])
    ->send();
```

If You want to send a FCM with both data & notification parameter, this is an example of usage sending a FCM with both data & notification parameter :

```php
fcm()
    ->to($recipients) // $recipients must an array
    ->priority('normal')
    ->timeToLive(0)
    ->data([
        'title' => 'Test FCM',
        'body' => 'This is a test of FCM',
    ])
    ->notification([
        'title' => 'Test FCM',
        'body' => 'This is a test of FCM',
    ])
    ->send();
```
