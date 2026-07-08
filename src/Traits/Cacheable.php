<?php

namespace Zerexei\PHPToolkit\Traits;

use Illuminate\Support\Facades\Cache;

trait Cacheable
{
    /**
     * Get a unique cache key for the model instance.
     */
    public function getCacheKey(): string
    {
        $timestamp = isset($this->updated_at) ? $this->updated_at->timestamp : 'no-timestamp';
        return sprintf('%s-%s-%s', get_class($this), $this->getKey(), $timestamp);
    }

    /**
     * Determine if an item exists in the cache for this model.
     */
    public function hasCache(): bool
    {
        return Cache::has($this->getCacheKey());
    }

    /**
     * Retrieve an item from the cache for this model.
     */
    public function getCache(mixed $default = null): mixed
    {
        return Cache::get($this->getCacheKey(), $default);
    }

    /**
     * Store an item in the cache for this model.
     */
    public function putCache(mixed $value, int|\DateTimeInterface|\DateInterval|null $ttl = null): bool
    {
        return Cache::put($this->getCacheKey(), $value, $ttl);
    }

    /**
     * Get an item from the cache, or execute the given Closure and store the result.
     */
    public function rememberCache(int|\DateTimeInterface|\DateInterval|null $ttl, callable $callback): mixed
    {
        return Cache::remember($this->getCacheKey(), $ttl, $callback);
    }

    /**
     * Get an item from the cache, or execute the given Closure and store the result forever.
     */
    public function rememberForeverCache(callable $callback): mixed
    {
        return Cache::rememberForever($this->getCacheKey(), $callback);
    }

    /**
     * Remove the item from the cache for this model.
     */
    public function forgetCache(): bool
    {
        return Cache::forget($this->getCacheKey());
    }
}
