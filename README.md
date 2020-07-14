# Laravel FakeID

[![Build Status](https://github.com/oanhnn/laravel-fakeid/workflows/CI/badge.svg)](https://github.com/oanhnn/laravel-fakeid/actions)
[![Coverage Status](https://img.shields.io/coveralls/github/oanhnn/laravel-fakeid/master.svg)](https://coveralls.io/github/oanhnn/laravel-fakeid)
[![Latest Version](https://img.shields.io/packagist/v/oanhnn/laravel-fakeid.svg?label=latest%20version)](https://packagist.org/packages/oanhnn/laravel-fakeid)
[![Total Downloads](https://img.shields.io/packagist/dt/oanhnn/laravel-fakeid.svg)](https://packagist.org/packages/oanhnn/laravel-fakeid)
[![Requires PHP](https://img.shields.io/packagist/php-v/oanhnn/laravel-fakeid.svg)](https://packagist.org/packages/oanhnn/laravel-fakeid)
[![Software License](https://img.shields.io/github/license/oanhnn/laravel-fakeid.svg)](LICENSE)

Easy fake model ID on URL Laravel Application.

## Requirements

* php >=7.2
* Laravel 7.0+

> Laravel 5.5+ using version 1.x (require php 7.1.3+)

## Installation

Begin by pulling in the package through Composer.

```bash
$ composer require oanhnn/laravel-fakeid
```

Publish config file with

```bash
$ php artisan vendor:publish --provider="Laravel\\FakeId\\ServiceProvider"
```

or 

```bash
php artisan vendor:publish --tag=laravel-fakeid-config
```

Edit `config/fakeid.php` for config specific drivers.

## Usage

### Getting start

In your model class, add implement interface `ShouldFakeId` and a trait `RoutesWithFakeId`:

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\FakeId\Contracts\ShouldFakeId;
use Laravel\FakeId\RoutesWithFakeId;

class MyModel extends Model implements ShouldFakeId
{
    use RoutesWithFakeId;
 
    // other logic
}
```


### Using specific driver

By default, `RoutesWithFakeId` use default driver, it is set in config file. You can override `getFakeIdDriver()` method to use specific driver:

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\FakeId\Contracts\ShouldFakeId;
use Laravel\FakeId\Contracts\Driver;
use Laravel\FakeId\Facades\FakeId;
use Laravel\FakeId\RoutesWithFakeId;

class MyModel extends Model implements ShouldFakeId
{
    use RoutesWithFakeId;

    /**
     * @return \Laravel\FakeId\Contracts\Driver
     */
    public function getFakeIdDriver() : Driver
    {
        return FakeId::driver('hex');
        // or create driver instance
        // return new HexDriver();
    }
}
```

> **Note** With each drivers, the input data format may be different, but the output data after decode is same with input
>
> | Driver    | Input type | Encoded type | Decoded type |
> |-----------|------------|--------------|--------------|
> | base64    | string     | string       | string       |
> | hashids   | int[]      | string       | int[]        |
> | hex       | string     | string       | string       |
> | optimus   | int        | int          | int          |
> | prefix    | string     | string       | string       |
> | chain     | string     | string       | string       |

### Custom driver

You can also create custom driver by implements `Laravel\FakeId\Contracts\Driver` interface

```php

namespace App;

use Laravel\FakeId\Contracts\Driver;

class CustomDriver implements Driver
{
    // your driver logic
}    
```

And register with FakeId Manager by add below code to `AppServiceProvider::boot()` method

```php
<?php

namespace App\Providers;

use App\CustomDriver;
use Illuminate\Support\ServiceProvider;
use Laravel\FakeId\Facades\FakeId;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        FakeId::extend('custom', function($app) {
            return new CustomDriver();
        });

        // other logic
    }
}
```

Now, you can use it

```php
<?php

use Laravel\FakeId\Facades\FakeId;

FakeId::driver('custom')->encode('123');

```

## Changelog

See all change logs in [CHANGELOG](CHANGELOG.md)

## Testing

```bash
$ git clone git@github.com/oanhnn/laravel-fakeid.git /path
$ cd /path
$ composer install
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email to [Oanh Nguyen](mailto:oanhnn.bk@gmail.com) instead of 
using the issue tracker.

## Credits

- [Oanh Nguyen](https://github.com/oanhnn)
- [All Contributors](../../contributors)

## License

This project is released under the MIT License.   
Copyright © [Oanh Nguyen](https://oanhnn.github.io).
