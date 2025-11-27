<?php

namespace App\Helpers;

class ProfanityFilter
{
    private static $badWords = [
        'sialan',
        'anjing', 
        'bangsat',
        'kampret',
        'goblok',
        'kontol'
    ];

    public static function filter($text)
    {
        $filteredText = $text;
        
        foreach (self::$badWords as $badWord) {
            // Case insensitive replacement
            $pattern = '/\b' . preg_quote($badWord, '/') . '\b/i';
            $replacement = str_repeat('*', strlen($badWord));
            $filteredText = preg_replace($pattern, $replacement, $filteredText);
        }
        
        return $filteredText;
    }

    public static function containsBadWords($text)
    {
        foreach (self::$badWords as $badWord) {
            if (stripos($text, $badWord) !== false) {
                return true;
            }
        }
        return false;
    }

    public static function getBadWordsCount($text)
    {
        $count = 0;
        foreach (self::$badWords as $badWord) {
            $count += substr_count(strtolower($text), strtolower($badWord));
        }
        return $count;
    }
}