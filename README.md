# PHP-toolkit

A collection of reusable PHP traits, utilities, and extensions designed to help developers build applications faster.

## Features

* Cacheable components and data handling
* Activity logging support
* Searchable functionality
* Reusable PHP utilities and extensions
* More lightweight PHP components coming soon

## Installation

Install the package via Composer:

```bash
composer require zerexei/php-toolkit
```

## Usage

### Cacheable

Add caching support to your class:

```php
use Zerexei\PhpToolkit\Traits\Cacheable;

class Post
{
    use Cacheable;
}
```

### HasActivityLogs

Add activity logging support:

```php
use Zerexei\PhpToolkit\Traits\HasActivityLogs;

class User
{
    use HasActivityLogs;
}
```

### Searchable

Add searchable functionality:

```php
use Zerexei\PhpToolkit\Traits\Searchable;

class Post
{
    use Searchable;
}
```

## Requirements

* PHP 8.2+
* Composer

## Package Information

```json
{
  "name": "zerexei/php-toolkit",
  "description": "A PHP toolkit containing reusable traits, helpers, and extensions",
  "license": "MIT"
}
```

## Roadmap / TODO (MVP)

The following features are planned for future releases:

### Traits

* [x] `Cacheable` — Add caching support for classes and data
* [x] `HasActivityLogs` — Add reusable activity logging capabilities
* [x] `Searchable` — Add simple searching capabilities
* [ ] `HasUuid` — UUID generation and handling
* [ ] `HasSlug` — Automatic slug generation
* [ ] `HasStatus` — Status management helpers
* [ ] `HasPermissions` — Reusable permission handling
* [ ] `HasMedia` — Common media/file attachment helpers
* [ ] `HasFilters` — Reusable filtering support

### Utilities

* [ ] String manipulation helpers
* [ ] Array manipulation helpers
* [ ] Date/time helpers
* [ ] Common PHP validation helpers
* [ ] File handling utilities

### Developer Experience

* [ ] Configuration support
* [ ] Better documentation and examples
* [ ] Expanded test coverage
* [ ] Additional reusable PHP components

## Long-Term Goals

* Keep the toolkit lightweight and framework agnostic
* Support modern PHP development practices
* Avoid unnecessary dependencies
* Provide reusable solutions for common application patterns
* Maintain compatibility across different PHP projects and frameworks

## License

The MIT License (MIT).
