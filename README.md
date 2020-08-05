# Multiple environment secured variables for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dejury/envcrypt.svg?style=flat-square)](https://packagist.org/packages/dejury/envcrypt)
[![Build Status](https://img.shields.io/travis/dejury/envcrypt/master.svg?style=flat-square)](https://travis-ci.org/dejury/envcrypt)
[![Quality Score](https://img.shields.io/scrutinizer/g/dejury/envcrypt.svg?style=flat-square)](https://scrutinizer-ci.com/g/dejury/envcrypt)
[![Total Downloads](https://img.shields.io/packagist/dt/dejury/envcrypt.svg?style=flat-square)](https://packagist.org/packages/dejury/envcrypt)

This package gives you the possibility to store certain values you would normally store in your .env file in an encrypted file which can be part of your version control. It supports the storage for multiple environments and automatically loads the variables for the current environment. They will be available in the env() function.

Package inspired by:

[BeyondCode laravel-credentials](https://github.com/beyondcode/laravel-credentials)  
[Stechstudio Laravel Env Security](https://github.com/stechstudio/laravel-env-security)

## Installation

You can install the package via composer:

```bash
composer require dejury/envcrypt
```

Copy the corresponding config file to your laravel directory by executing:

```bash
php artisan vendor:publish --provider="Dejury\Envcrypt\EnvcryptServiceProvider"
```

It is highly recommended to use another encryption key then the default application key. Also it is highly recommended that the encryption key is not stored in version control. You can set the available environments inside the config, this is for letting the application know which environments to save if you choose to save all environments.  

By default the encrypted files are stored in the root of your laravel project, you can change this in the config.

## Usage

``` php
php artisan envcrypt:add KEY_NAME
```
Will save OR edit the corresponding KEY_NAME with the value that will be asked during execution of the command. You can also set an environment or choose to store to all environments.

``` php
php artisan envcrypt:remove KEY_NAME
```
Will REMOVE the corresponding KEY_NAME. You can also set an environment or choose to remove to all environments.

``` php
php artisan envcrypt:view ENVIRONMENT
```
See all the stored values for that ENVIRONMENT. Will show in JSON format.

``` php
$encryptedEnv = env('KEY_NAME'); // just like you are used to in Laravel
```

### Testing

``` bash
composer test
```

### Is this package secure?
The goal of this package is to store certain ENV vars encrypted. For example API_KEYS. You can safely store them in version control and it will automatically be available on the server where it is deployed.  
This makes it easier to deploy ENV vars through all of your different environments.  

Of course: this package uses a key to encrypt and decrypt the data. The key should be stored securely, to prevent decryption by unwanted persons. Whenever somebody has access to the server it is always possible to see the decrypted values by using the artisan commands or to manually decrypt the files.
This package is always better to use in version control then storing PLAIN values.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email jonathan@hafka.mp instead of using the issue tracker.

## Credits

- [Jonathan Hafkamp](https://github.com/dejury)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
