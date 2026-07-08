<?php

namespace Zerexei\PHPToolkit\Utilities;

class StrHelper
{
    /**
     * Generate initials from a name (e.g. "John Doe" -> "JD").
     */
    public static function initials(string $name): string
    {
        $words = preg_split("/\s+/", trim($name));
        $initials = '';

        foreach ($words as $word) {
            if ($word !== '') {
                $initials .= mb_substr($word, 0, 1);
            }
        }

        return mb_strtoupper($initials);
    }

    /**
     * Estimate reading time for a text in minutes.
     */
    public static function readingTime(string $text, int $wordsPerMinute = 200): int
    {
        $wordCount = str_word_count(strip_tags($text));
        return (int) ceil($wordCount / max(1, $wordsPerMinute));
    }

    /**
     * Truncate a string to a specific length, preserving whole words.
     */
    public static function truncateWords(string $text, int $limit = 100, string $end = '...'): string
    {
        if (mb_strlen($text) <= $limit) {
            return $text;
        }

        $truncated = mb_substr($text, 0, $limit);
        $lastSpace = mb_strrpos($truncated, ' ');

        if ($lastSpace !== false) {
            $truncated = mb_substr($truncated, 0, $lastSpace);
        }

        return $truncated . $end;
    }
}
