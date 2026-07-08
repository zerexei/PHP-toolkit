<?php

namespace Zerexei\PHPToolkit\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    /**
     * Boot the trait to generate UUIDs on model creation.
     */
    protected static function bootHasUuid(): void
    {
        static::creating(function ($model) {
            foreach ($model->getUuidColumns() as $column) {
                if (empty($model->{$column})) {
                    $model->{$column} = (string) Str::uuid();
                }
            }
        });
    }

    /**
     * Get the columns that should receive a UUID.
     */
    public function getUuidColumns(): array
    {
        return [$this->getKeyName()];
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     */
    public function getIncrementing(): bool
    {
        if (in_array($this->getKeyName(), $this->getUuidColumns())) {
            return false;
        }

        return parent::getIncrementing();
    }

    /**
     * Get the auto-incrementing key type.
     */
    public function getKeyType(): string
    {
        if (in_array($this->getKeyName(), $this->getUuidColumns())) {
            return 'string';
        }

        return parent::getKeyType();
    }
}
