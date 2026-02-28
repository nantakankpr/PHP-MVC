<?php

namespace App\Helpers;

class Helper
{
    /**
     * Sanitize input to prevent XSS attacks.
     *
     * @param string $data Input data to be sanitized.
     * @return string Sanitized data.
     */
    public static function sanitizeInput($data)
    {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Format a date to a specific format.
     *
     * @param string $date Date string.
     * @param string $format Desired date format.
     * @return string Formatted date.
     */
    public static function formatDate($date, $format = 'Y-m-d')
    {
        return date($format, strtotime($date));
    }
}
