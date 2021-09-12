<?php
use JetBrains\PhpStorm\ArrayShape;

/**
 * @param string $completed_at Передаём время закрытия лота
 * @return array{hours: string, minutes: string} Возвращается массив состоящий из часов и минут
 */
#[ArrayShape(['hours' => "string", 'minutes' => "string"])]
function formatTime(string $completed_at): array
{
    $now_date = date_create('now');
    $next_date = date_create($completed_at);
    if ($now_date > $next_date) {
        $hours = '00';
        $minutes = '00';
    } else {
        $diff = date_diff($now_date, $next_date);
        $hours_format = $diff->format('%a') ?
                        $diff->format('%H') :
                        $diff->format('%a') * 24 + $diff->format('%H');
        $minute_format = $diff->format('%I');
        $hours = str_pad($hours_format, 2, '0', STR_PAD_LEFT);
        $minutes = str_pad($minute_format, 2, '0', STR_PAD_LEFT);
    }
    return ['hours' => $hours, 'minutes' => $minutes];
}

/**
* @param string $number Передаём цену
* @return string  Возвращаем строку - тысячное представление суммы со знаком ₽
*/

function formatPrice(string $number): string
{
    $round_numb = ceil((float)$number);
    return number_format($round_numb, 0, '', ' ') . ' ₽';
}
