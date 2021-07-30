<?php

    function formatSumm(float $number)
    {
        $round_numb = ceil($number);
        if ( $round_numb < 1000 ) {
            return $round_numb . ' ₽';
        } else {
            $finish_price = number_format($round_numb, 0, '', ' ') . ' ₽';
            return $finish_price;
        }
    }

    function xssAdg($e)
    {
        return htmlspecialchars($e);
    }
