<?php

    function formatSumm(float $number)
    {
        $round_numb = ceil( $number );
        if ( $round_numb < 1000 ) {
            return $round_numb . ' ₽';
        } else {
            return number_format( $round_numb, 0, '', ' ' ) . ' ₽';
        }
    }

    function xssAdg($e)
    {
        return htmlspecialchars( $e );
    }


    function get_dt_range(string $date)
    {
        $now_date = date_create( 'now' );
        $next_date = date_create( $date );
        if ( $now_date > $next_date ) {
            $hours = '00';
            $minutes = '00';
        } else {
            $diff = date_diff( $now_date, $next_date );
            $hours = $diff -> format( '%a' ) ? $diff -> format( '%H' ) : $diff -> format( '%a' ) * 24 + $diff
                    -> format( '%H' );
            $minutes = $diff -> format( '%I' );
        }
        return [(int) $hours, (int) $minutes];
    }
