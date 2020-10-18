# Deutsche Bahn Timetables

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

"Deutsche Bahn" is a laravel package for timetables of german railway stations

## Installation

Via Composer

``` bash
$ composer require kayschima/deutsche-bahn
```


## Usage
The usage of the package is quite simple:
- Get you API token at 
(https://developer.deutschebahn.com/store/).
- Fetch this package via Composer
- Set your API token in your .env file:

``` bash
DEUTSCHE_BAHN_API_TOKEN=YOUR_API_TOKEN
```
### Facade
You can use three different functions in this package:

``` bash
use Kayschima\DeutscheBahn\Facades\DeutscheBahn;

$arrivals = DeutscheBahn::getArrivals('8000050', new DateTime('now'),true);
$departures = DeutscheBahn::getDepartures('8000050', new DateTime('now'), false);
$trainDetails = DeutscheBahn::getDetails('8000050hewrl7127871329172023440423023lhlhllklhlh50');
```
The first two functions expect
- an id a train station in Germany (in this example 'Bremen')
- a DateTime instance for date and time of the arrivals/departures
- a boolean (details of the train wanted of not)

If you want to know details about a specific train journey, enter the id of that train journey in the 'getDetails' function.
You might get these ids by calling 'getArrivals' or 'getDepartures' before.

All functions return an array as a result. In later versions of the package we will also pass the results of the REST call on to the user.

Until then, an empty array is returned as the function result if an error occurs when calling the Deutsche Bahn api or the function has generally not determined any results.

### Artisan command
This package also provides an artisan coommand to get the id of a certain railway station of Deutsche Bahn.
``` bash
php artisan deutsche-bahn:railway-station
```
Just answer the question about the desired train station and a number of possible IDs will be displayed.
## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Kay Markschies][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/kayschima/deutsche-bahn.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/kayschima/deutsche-bahn.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/kayschima/deutsche-bahn/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/kayschima/deutsche-bahn
[link-downloads]: https://packagist.org/packages/kayschima/deutsche-bahn
[link-travis]: https://travis-ci.org/kayschima/deutsche-bahn
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/kayschima
[link-contributors]: ../../contributors
