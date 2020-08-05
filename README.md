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

## Usage

``` php
// Usage description here
```

### Testing

``` bash
composer test
```

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
