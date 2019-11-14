# PayseraRestMigrationBundle

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

Bundle that allows migration from old configuration (v4) format to new one (v5) 
in `paysera/lib-rest-bundle`.

Basically it does two things:
- maintains backward-compatibility with `paysera/lib-rest-bundle` `4.x` version;
- adds support for `paysera/lib-normalization-bundle` when using old configuration format.

## Why?

Classes for old configuration were not just deprecated in the main library – they
were totally removed there to have fresh start, but copied in this library if you'd still like to
use old format. It allows to migrate endpoint-by-endpoint using both configuration formats simultaneously.

So, due to a bit strange nature of the bundle, it also includes classes and services from 
`Paysera\Bundle\RestBundle` namespace – those which were deleted from `paysera/lib-rest-bundle` `5.0`
version.

## Installation

```bash
composer require paysera/lib-rest-migration-bundle
```

## Configuration

```yaml
paysera_rest_migration_bundle:
  property_path_converter: service_id # optional
```

## Usage

Install and use `4.x` configuration in `lib-rest-bundle`, even when using `5.x` versions and above.
Migrate when the opportunity appears, though.

Keep in mind the changes in
[CHANGELOG](https://github.com/paysera/lib-rest-bundle/blob/master/CHANGELOG.md) – some aspects
were changed in-place and still broke backward-compatibility.

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
