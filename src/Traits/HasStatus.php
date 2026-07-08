<?php

namespace Zerexei\PHPToolkit\Traits;

use Illuminate\Database\Eloquent\Builder;
use InvalidArgumentException;

trait HasStatus
{
    /**
     * Get the database column name for status.
     */
    public function getStatusColumn(): string
    {
        return 'status';
    }

    /**
     * Get the list of allowed statuses. Override in model.
     */
    public function getStatuses(): array
    {
        return [];
    }

    /**
     * Set the status of the model.
     *
     * @throws InvalidArgumentException
     */
    public function setStatus(string $status): bool
    {
        $allowed = $this->getStatuses();

        if (!empty($allowed) && !in_array($status, $allowed, true)) {
            throw new InvalidArgumentException("Status '{$status}' is not allowed for this model.");
        }

        $this->{$this->getStatusColumn()} = $status;
        return $this->save();
    }

    /**
     * Check if the model has a specific status.
     */
    public function isStatus(string $status): bool
    {
        return $this->{$this->getStatusColumn()} === $status;
    }

    /**
     * Scope a query to only include models of specific statuses.
     */
    public function scopeOfStatus(Builder $query, array|string $statuses): Builder
    {
        return $query->whereIn($this->getStatusColumn(), (array) $statuses);
    }
}
