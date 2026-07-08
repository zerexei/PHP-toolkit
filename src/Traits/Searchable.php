<?php

namespace Zerexei\PHPToolkit\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Searchable
{
    /**
     * Scope a query to search by keys and value.
     */
    public function scopeSearch(Builder $query, array|string $keys, ?string $value): Builder
    {
        if (empty($value) || trim($value) === '') {
            return $query;
        }

        return $query->where(function (Builder $query) use ($keys, $value) {
            Str::of($value)
                ->explode(' ')
                ->filter()
                ->each(function (string $term) use ($query, $keys) {
                    $query->where(function (Builder $subQuery) use ($keys, $term) {
                        foreach ((array) $keys as $key) {
                            $subQuery->orWhere($key, 'LIKE', $term . '%');
                        }
                    });
                });
        });
    }
}
