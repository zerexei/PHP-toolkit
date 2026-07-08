<?php

namespace Zerexei\PHPToolkit\Traits;

use Spatie\Activitylog\Traits\LogsActivity as SpatieLogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;

trait HasActivityLogs
{
    use SpatieLogsActivity;

    /**
     * Tap into the activity log before saving.
     */
    public function tapActivity(Activity $activity): void
    {
        $request = request();
        $activity->ip_address = $request ? $request->ip() : null;
        $activity->navigation = "Model";
    }

    /**
     * Set the default activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        $modelName = Str::headline(class_basename($this::class));

        $getDescription = function (string $eventName) use ($modelName) {
            $eventName = Str::headline($eventName);
            return "{$modelName} has been {$eventName}";
        };

        return LogOptions::defaults()
            ->logAll()
            ->logExcept(['created_at', 'updated_at', 'password', 'remember_token'])
            ->setDescriptionForEvent($getDescription)
            ->dontLogIfAttributesChangedOnly(['remember_token'])
            ->dontSubmitEmptyLogs()
            ->useLogName($modelName);
    }
}
