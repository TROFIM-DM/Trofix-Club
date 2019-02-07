<?php
namespace trofix\scripts\system;

use std, trofix;

/**
 * Класс для работы с файлами.
 * 
 * @author Дмитрий Трофимов
 * @url https://github.com/TROFIM-DM/Trofix-Club
 */
class FileSystem
{
    
    /**
     * Список привязанных файлов к программе.
     * 
     * @var array
     */
    private static $fileStream = [];
    
    /**
     * Привязать файл к программе.
     * 
     * @param string $path
     * @return bool
     */
    static function registerFile (string $path) : bool
    {
        if (Stream::exists($path) && !self::$fileStream[fs::name($path)]) 
            self::$fileStream[fs::name($path)] = ResourceStream::of($path);
        return (self::$fileStream[fs::name($path)]) ? true : false;
    }
    
    /**
     * Отвязать файл от программы.
     * 
     * @param string $path
     * @return bool
     */
    static function unRegisterFile (string $path) : bool
    {
        if (Stream::exists($path) && self::$fileStream[fs::name($path)]) {
            self::$fileStream[fs::name($path)]->close();
            unset(self::$fileStream[fs::name($path)]);
        }
        return (!self::$fileStream[fs::name($path)]) ? true : false;
    }
    
}