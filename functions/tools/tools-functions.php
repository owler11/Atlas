<?php
/**
 * General Functions
 *
 * @package mingo
 */
/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Format Event Dates
--------------------------------------------------------------*/

// 1.0 - Format Event Dates
/**
 * Helper function to format event dates.
 *
 * @param string $start_date The start date in 'Y-m-d H:i:s' format.
 * @param string $end_date The end date in 'Y-m-d H:i:s' format.
 * @param bool $include_time Whether to include time in the formatted output.
 * @return string The formatted event date(s).
 */
function format_event_dates_helper($start_date, $end_date, $include_time = true) {
    // Check if both start and end dates are provided
    if ($start_date && $end_date) {
        // Format the start and end dates
        $start_date_formatted = date('F j', strtotime($start_date));
        $end_date_formatted = date('F j, Y', strtotime($end_date));

        // Extract and format the times if needed
        $start_time_formatted = $include_time ? date('g:i A', strtotime($start_date)) : '';
        $end_time_formatted = $include_time ? date('g:i A', strtotime($end_date)) : '';

        // Check if the start and end dates are the same
        if (date('Y-m-d', strtotime($start_date)) == date('Y-m-d', strtotime($end_date))) {
            // If the dates are the same, only show the start date and time if needed
            $formatted_date = date('F j, Y', strtotime($start_date));
            $formatted_time = $start_time_formatted . ' - ' . $end_time_formatted;
        } else {
            // Check if the start and end dates are in the same year
            if (date('Y', strtotime($start_date)) == date('Y', strtotime($end_date))) {
                // Check if the start and end dates are in the same month
                if (date('F', strtotime($start_date)) == date('F', strtotime($end_date))) {
                    // If the dates are in the same month, format the end date to show only the day and year
                    $end_date_formatted = date('j, Y', strtotime($end_date));
                } else {
                    // If the dates are in different months, format the end date to show the month, day, and year
                    $end_date_formatted = date('F j, Y', strtotime($end_date));
                }
            }

            // Combine the formatted start and end dates
            $formatted_date = $start_date_formatted . ' - ' . $end_date_formatted;
            $formatted_time = $start_time_formatted . ' - ' . $end_time_formatted;
        }
    } else {
        // If only the start date is provided, format it to show the month, day, and year
        $formatted_date = date('F j, Y', strtotime($start_date));
        $formatted_time = $include_time ? date('g:i A', strtotime($start_date)) : '';
    }

    // Combine the formatted date and time if needed
    if ($include_time && $formatted_time) {
        return $formatted_date . ' at ' . $formatted_time;
    } else {
        return $formatted_date;
    }
}

/**
 * Format event dates with time.
 *
 * @param string $start_date The start date in 'Y-m-d H:i:s' format.
 * @param string $end_date The end date in 'Y-m-d H:i:s' format.
 * @return string The formatted event date(s) with time.
 */
function format_event_dates($start_date, $end_date) {
    return format_event_dates_helper($start_date, $end_date, true);
}

/**
 * Format event dates without time.
 *
 * @param string $start_date The start date in 'Y-m-d H:i:s' format.
 * @param string $end_date The end date in 'Y-m-d H:i:s' format.
 * @return string The formatted event date(s) without time.
 */
function format_event_dates_without_time($start_date, $end_date) {
    return format_event_dates_helper($start_date, $end_date, false);
}