# Laravel SMS
-------------

[![Build Status][ico-travis]][link-travis]
[![Code Coverage][ico-codecov]][link-codecov]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE)

### Installation

To install this package you will need:

 - Laravel >= 5.6
 - PHP 7.1.3+


Run this command to install via composer

```
composer require linkstreet/laravel-sms
```

or edit the `composer.json` 

```
"require": {
    "linkstreet/laravel-sms": "^3.0"
}
```

Then run composer update in your terminal to pull the package.

Now all you have to do is to add the service provider of the package and alias the packages. To do open your `app/config/app.php` file.

Add a new line to the `providers` array

```php
Linkstreet\LaravelSms\Providers\SmsServiceProvider::class
```

Finally add a line to `aliases` array

```php
'SMS' => Linkstreet\LaravelSms\Facades\Sms::class,
```

Run this command to publish package configuration in `config` folder

```php
php artisan vendor:publish --provider='Linkstreet\LaravelSms\Providers\SmsServiceProvider'
```


### Supported SMS gateway providers
 - [KAP System](https://kapsystem.com)
 - [Twilio](https://www.twilio.com/)


### Coming Soon
 - Docs
 - Changelog
 - Examples


### License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-travis]: https://travis-ci.org/linkstreet/laravel-sms.svg?branch=master
[ico-codecov]: https://codecov.io/github/linkstreet/laravel-sms/coverage.svg?branch=master
[ico-version]: https://poser.pugx.org/linkstreet/laravel-sms/v/stable
[ico-downloads]: https://poser.pugx.org/linkstreet/laravel-sms/downloads
[ico-license]: https://poser.pugx.org/linkstreet/laravel-sms/license

[link-travis]: https://travis-ci.org/linkstreet/laravel-sms
[link-codecov]: https://codecov.io/github/linkstreet/laravel-sms?branch=master
[link-packagist]: https://packagist.org/packages/linkstreet/laravel-sms
[link-downloads]: https://packagist.org/packages/linkstreet/laravel-sms
[link-license]: LICENSE