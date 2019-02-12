<?php
namespace trofix\scripts\time;

use std;

/**
 * Класс для работы с временем.
 * 
 * @author Дмитрий Трофимов
 * @url https://github.com/TROFIM-DM/Trofix-Club
 */
class TimeHint 
{
    
    /**
     * Получить время в VK формате.
     * 
     * @param int $date
     * 
     * @return string
     */
    public static function getHint (int $date) : string
    {
        $time = new Time($date * 1000);
        if ($time->year() == Time::now()->year())
            if ($time->month() == Time::now()->month()) {
                if ($time->day() == Time::now()->day())
                    $return = $time->toString('Сегодня в HH:mm');
                if ($time->day() != Time::now()->day())
                    $return = $time->toString('dd ' . substr(self::getMonth($time->month()), 0, 3) . ' в HH:mm');
                if ($time->add(['day' => '+1'])->day() == Time::now()->day())
                    $return = $time->toString('Вчера в HH:mm');
            } else $return = $time->toString('dd ' . substr(self::getMonth($time->month()), 0, 3) . ' в HH:mm');
        else $return = $time->toString('dd.MM.yyyy в HH:mm');
        
        return $return;
    }
    
    /**
     * Получить месяц.
     * 
     * @param int $month
     * 
     * @return string
     */
    private static function getMonth (int $month) : string
    {
        switch ($month) {
            case 1:
                $return = 'Январь';
            break;
            case 2:
                $return = 'Февраль';
            break;
            case 3:
                $return = 'Март';
            break;
            case 4:
                $return = 'Апрель';
            break;
            case 5:
                $return = 'Май';
            break;
            case 6:
                $return = 'Июнь';
            break;
            case 7:
                $return = 'Июль';
            break;
            case 8:
                $return = 'Август';
            break;
            case 9:
                $return = 'Сентябрь';
            break;
            case 10:
                $return = 'Октябрь';
            break;
            case 11:
                $return = 'Ноябрь';
            break;
            case 12:
                $return = 'Декабрь';
            break;
        }
        return $return;
    }
    
}