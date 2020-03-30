# PayseraRestMigrationBundle

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

Bundle that allows easier migration from [`paysera/lib-rest-bundle`](https://github.com/paysera/lib-rest-bundle) 
to [`paysera/lib-api-bundle`](https://github.com/paysera/lib-api-bundle).

It helps with the following:
- supporting some of the old parameters and headers from `lib-rest-bundle` for use in `lib-api-bundle`;
- supporting exceptions and some responsef from `lib-rest-bundle` for use in `lib-api-bundle`.

## Why?

For new functionality we should just use `lib-api-bundle` classes and parameters. For older ones, we still need
to support backward compatibility while migrating, so it's easier to migrate in the following fashion:
* change endpoints to use `lib-api-bundle`, but possibly with older parameters, exceptions etc.
* support for new exceptions, parameters and other things comes by-default;
* we can migrate the functionality, services, frontend to the new parameters;
* we can clean up afterwards, using only newer functionality.

## Installation

```bash
composer require paysera/lib-rest-migration-bundle
```

## Semantic versioning

This library follows [semantic versioning](http://semver.org/spec/v2.0.0.html).

See [Symfony BC rules](http://symfony.com/doc/current/contributing/code/bc.html) for basic
information about what can be changed and what not in the API.

## Running tests

```
composer update
composer test
```

## Contributing

Feel free to create issues and give pull requests.

You can fix any code style issues using this command:
```
composer fix-cs
```

[ico-version]: https://img.shields.io/packagist/v/paysera/lib-rest-migration-bundle.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/paysera/lib-rest-migration-bundle/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/paysera/lib-rest-migration-bundle.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/paysera/lib-rest-migration-bundle
[link-travis]: https://travis-ci.org/paysera/lib-rest-migration-bundle
[link-downloads]: https://packagist.org/packages/paysera/lib-rest-migration-bundle
