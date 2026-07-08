<?php

namespace Zerexei\PHPToolkit\Utilities;

class ArrHelper
{
    /**
     * Group an array of associative arrays or objects by a key.
     */
    public static function groupByKey(array $array, string|int $key): array
    {
        $grouped = [];

        foreach ($array as $item) {
            $groupKey = is_object($item) ? ($item->{$key} ?? null) : ($item[$key] ?? null);

            if ($groupKey !== null) {
                $grouped[$groupKey][] = $item;
            }
        }

        return $grouped;
    }

    /**
     * Recursively filter null values out of an array.
     */
    public static function filterNullRecursive(array $array): array
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                $value = self::filterNullRecursive($value);
            }
        }

        return array_filter($array, function ($value) {
            return $value !== null;
        });
    }

    /**
     * Rename the keys of an associative array based on a map.
     */
    public static function renameKeys(array $array, array $map): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            $newKey = $map[$key] ?? $key;
            $result[$newKey] = is_array($value) ? self::renameKeys($value, $map) : $value;
        }

        return $result;
    }
}
