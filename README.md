# Laravel SMS
-------------

[![Build Status][ico-travis]][link-travis]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE)

### Installation

To install this package you will need:

 - Laravel 5
 - PHP 5.4+


Run this command to install via composer

```
composer require linkstreetlearning/laravel-sms
```

or edit the `composer.json` 

```
"require": {
    "linkstreetlearning/laravel-sms": "^0.1.0"
}
```

Then run composer update in your terminal to pull the package.

Now all you have to is add the service provider of the package and alias the packages. To do open your `app/config/app.php` file.

Add a new line to the `providers` array

```php
Linkstreet\LaravelSms\Providers\SmsServiceProvider::class
```

Finally add a line to `aliases` array

```php
'SMS' => Linkstreet\LaravelSms\Facades\Sms::class,
```

### Comming Soon
 - Docs
 - Changelog
 - Examples
 - Unit test

### License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-travis]: https://travis-ci.org/linkstreetlearning/laravel-sms.svg?branch=master
[ico-version]: https://poser.pugx.org/linkstreetlearning/laravel-sms/v/stable
[ico-downloads]: https://poser.pugx.org/linkstreetlearning/laravel-sms/downloads
[ico-license]: https://poser.pugx.org/linkstreetlearning/laravel-sms/license

[link-travis]: https://travis-ci.org/linkstreetlearning/laravel-sms
[link-packagist]: https://packagist.org/packages/linkstreetlearning/laravel-sms
[link-downloads]: https://packagist.org/packages/linkstreetlearning/laravel-sms
[link-license]: LICENSE