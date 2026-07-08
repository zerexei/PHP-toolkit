<?php

namespace Zerexei\PHPToolkit\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    /**
     * Apply query filters to the model query builder.
     */
    public function scopeFilter(Builder $query, mixed $filters): Builder
    {
        if (is_object($filters) && method_exists($filters, 'apply')) {
            return $filters->apply($query);
        }

        if (is_string($filters) && class_exists($filters)) {
            $instance = new $filters(request());
            if (method_exists($instance, 'apply')) {
                return $instance->apply($query);
            }
        }

        if (is_callable($filters)) {
            $filters($query);
        }

        return $query;
    }
}
