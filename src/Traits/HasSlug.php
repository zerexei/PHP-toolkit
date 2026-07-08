<?php

namespace Zerexei\PHPToolkit\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    /**
     * Boot the trait to generate slugs on saving.
     */
    protected static function bootHasSlug(): void
    {
        static::saving(function ($model) {
            $model->generateSlug();
        });
    }

    /**
     * Generate the slug and set it on the model.
     */
    public function generateSlug(): void
    {
        $source = $this->slugSource();
        $destination = $this->slugDestination();

        if (empty($this->{$source})) {
            return;
        }

        if (empty($this->{$destination}) || $this->isDirty($source)) {
            $slug = Str::slug($this->{$source});
            $this->{$destination} = $this->makeSlugUnique($slug);
        }
    }

    /**
     * Ensure the generated slug is unique.
     */
    protected function makeSlugUnique(string $slug): string
    {
        $destination = $this->slugDestination();
        $originalSlug = $slug;
        $counter = 1;

        while (static::where($destination, $slug)
            ->where($this->getKeyName(), '!=', $this->getKey())
            ->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }

    /**
     * Get the source column for slug generation.
     */
    public function slugSource(): string
    {
        return 'title';
    }

    /**
     * Get the destination column for slug generation.
     */
    public function slugDestination(): string
    {
        return 'slug';
    }
}
