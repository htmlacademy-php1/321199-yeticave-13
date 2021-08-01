<?php

    function formatSumm(float $number)
    {
        $round_numb = ceil( $number );
        if ( $round_numb < 1000 ) {
            return $round_numb . ' ₽';
        } else {
            $finish_price = number_format( $round_numb, 0, '', ' ' ) . ' ₽';
            return $finish_price;
        }
    }

    function xssAdg($e)
    {
        return htmlspecialchars( $e );
    }


    function get_dt_range(string $date)
    {
        $nowDate = date_create( 'now' );
        $nextDate = date_create( $date );
        if ( $nowDate > $nextDate ) {
            $hour_count = '00';
            $minutes_count = '00';
        } else {
            $diff = date_diff( $nowDate, $nextDate );
            $hour_count = empty( $diff -> format( '%a' ) ) ? $diff -> format( '%H' ) : $diff -> format( '%a' ) * 24 + $diff -> format( '%H' );
            $minutes_count = $diff -> format( '%I' );
        }
        $arrHM = [(string) $hour_count, $minutes_count];
        return $arrHM;
    }
