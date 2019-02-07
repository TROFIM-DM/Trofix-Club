<?php
namespace trofix\scripts\system;

use windows;

/**
 * Класс для работы с данными путями.
 * 
 * @author Дмитрий Трофимов
 * @url https://github.com/TROFIM-DM/Trofix-Club
 */
class Path 
{
    
    /**
     * Папки необходимые для работы программы.
     * 
     * @return array
     */
    /*static function getAppFolder () : array
    {
        return ['\\disabled\\', '\\disabled\\mods\\', '\\nbt\\'];
    }*/
    
    /**
     * Путь к папке Temp.
     * 
     * @return string
     */
    static function getTemp () : string
    {
        return Windows::expandEnv('%TEMP%').'\\';
    }
    
    /**
     * Путь к временным файлам программы.
     * 
     * @return string
     */
    static function getAppTemp () : string
    {
        return Windows::expandEnv('%TEMP%').'\\Trofix Club\\';
    }
    
    /**
     * Путь к папке AppData.
     * 
     * @return string
     */
    static function getAppData () : string
    {
        return Windows::expandEnv('%APPDATA%').'\\';
    }
    
    /**
     * Путь к данным пользователя для программы.
     * 
     * @return string
     */
    static function getAppPath () : string
    {
        return Windows::expandEnv('%APPDATA%').'\\Trofix Club\\';
    }
    
}