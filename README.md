# Laravel & PHP Toolkit

[![Latest Version on Packagist](https://img.shields.io/packagist/v/zerexei/php-toolkit.svg?style=flat-square)](https://packagist.org/packages/zerexei/php-toolkit)
[![Total Downloads](https://img.shields.io/packagist/dt/zerexei/php-toolkit.svg?style=flat-square)](https://packagist.org/packages/zerexei/php-toolkit)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![PHP Version Compatibility](https://img.shields.io/badge/php-8.2%2B-blue.svg?style=flat-square)](https://php.net)
[![Laravel Components Compatibility](https://img.shields.io/badge/laravel--components-12.x-red.svg?style=flat-square)](https://laravel.com)

A collection of lightweight, modern, and highly reusable PHP traits, Eloquent helpers, and utility extensions designed to supercharge your Laravel development workflow.

---

## ⚡ Key Features

*   **`Cacheable`** — Intuitive Eloquent instance caching API with custom TTLs and auto-generated keys.
*   **`HasActivityLogs`** — Boilerplate-free Spatie Activitylog integration configured with smart defaults.
*   **`Searchable`** — Query-builder scope for full-text term searches matching prefixes.
*   **`HasUuid`** — Automatically generates secure UUIDs (v4) upon model creation.
*   **`HasSlug`** — Automatic generation of unique, collision-resistant slugs from a source field.
*   **`HasStatus`** — Status state management, validation checks, and query scoping.
*   **`HasFilters`** — Flexible pipeline helper to filter query builders via closures or dedicated classes.
*   **`StrHelper` / `ArrHelper`** — Context-rich utilities to manipulate strings and arrays cleanly.

---

## 📦 Installation

Install the package via Composer:

```bash
composer require zerexei/php-toolkit
```

---

## 🛠️ Usage Guides

### Cacheable
Add instance caching to any Eloquent model. It dynamically generates cache keys based on model type, primary key, and the `updated_at` timestamp.

```php
use Zerexei\PHPToolkit\Traits\Cacheable;

class Post extends Model
{
    use Cacheable;
}

// Check cache, retrieve, or store values
$post = Post::find(1);

if ($post->hasCache()) {
    $cachedData = $post->getCache();
}

$post->putCache('custom-serialized-data', 3600);
$post->forgetCache();
```

---

### HasActivityLogs
Integrate [Spatie's Laravel Activitylog](https://github.com/spatie/laravel-activitylog) with smart out-of-the-box settings (auto-headline model names, excludes sensitive fields, and logs request IPs).

```php
use Zerexei\PHPToolkit\Traits\HasActivityLogs;

class User extends Model
{
    use HasActivityLogs;
}
```

---

### Searchable
Enable simple, multi-column search on your models using SQL `LIKE` conditions.

```php
use Zerexei\PHPToolkit\Traits\Searchable;

class Product extends Model
{
    use Searchable;
}

// Query products matching "macbook pro" across title and description
$products = Product::search(['title', 'description'], 'macbook pro')->get();
```

---

### HasUuid
Instruct Eloquent to auto-generate and manage UUID keys (UUIDv4) on model creation.

```php
use Zerexei\PHPToolkit\Traits\HasUuid;

class Invoice extends Model
{
    use HasUuid;
}
```

---

### HasSlug
Automatically generate slugs on model saving. Handles slug collisions automatically by appending increments (e.g. `my-slug-1`).

```php
use Zerexei\PHPToolkit\Traits\HasSlug;

class Article extends Model
{
    use HasSlug;

    // Optional overrides:
    public function slugSource(): string
    {
        return 'title'; // Source column (Default: 'title')
    }

    public function slugDestination(): string
    {
        return 'slug'; // Destination column (Default: 'slug')
    }
}
```

---

### HasStatus
Validate, mutate, and scope models by their status.

```php
use Zerexei\PHPToolkit\Traits\HasStatus;

class Project extends Model
{
    use HasStatus;

    public function getStatuses(): array
    {
        return ['draft', 'active', 'completed', 'archived'];
    }
}

// Usage
$project->setStatus('active'); // Throws InvalidArgumentException if invalid
$project->isStatus('completed'); // false

// Scope queries
$activeProjects = Project::ofStatus('active')->get();
$filteredProjects = Project::ofStatus(['active', 'completed'])->get();
```

---

### HasFilters
Apply request-driven filters or query builder callbacks cleanly.

```php
use Zerexei\PHPToolkit\Traits\HasFilters;

class Order extends Model
{
    use HasFilters;
}

// 1. Using a closure
$orders = Order::filter(function ($query) {
    $query->where('amount', '>', 100);
})->get();

// 2. Using a dedicated Filter Class (must implement an `apply` method)
$orders = Order::filter(\App\Filters\OrderFilter::class)->get();
```

---

## 🧰 Utility Helpers

### StrHelper
Common string manipulations.

```php
use Zerexei\PHPToolkit\Utilities\StrHelper;

// Get initials
StrHelper::initials('Taylor Otwell'); // "TO"

// Estimate reading time in minutes
StrHelper::readingTime($longText, $wordsPerMinute = 200); // 4

// Truncate to exact length while preserving word boundaries
StrHelper::truncateWords($text, $limit = 80);
```

### ArrHelper
Manipulate PHP arrays effortlessly.

```php
use Zerexei\PHPToolkit\Utilities\ArrHelper;

// Group items by a key path (supports arrays & objects)
ArrHelper::groupByKey($users, 'role_id');

// Remove all null values recursively from nested arrays
ArrHelper::filterNullRecursive($dirtyArray);

// Safely rename associative array keys
ArrHelper::renameKeys($data, ['user_id' => 'id', 'user_email' => 'email']);
```

---

## 📋 Requirements

*   **PHP**: `8.2` or higher
*   **Laravel Components (`illuminate/database`, `illuminate/support`)**: `^12.0`
*   **Composer**

---

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
