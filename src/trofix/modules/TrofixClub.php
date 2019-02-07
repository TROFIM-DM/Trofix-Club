<?php
namespace trofix\modules;

use std, gui, framework, trofix;

/**
 * Главный модуль Trofix Club.
 * 
 * @author Дмитрий Трофимов
 * @url https://github.com/TROFIM-DM/Trofix-Club
 */
class TrofixClub extends AbstractModule
{
    
    /**
     * Главные константы.
     */
    private const APP_NAME           = 'Trofix Club',
                  APP_GITHUB         = 'https://github.com/TROFIM-YT/Trofix-Club/',
                  APP_SERVER         = '---',
                  APP_YOUTUBE        = 'http://bit.ly/TROFIM/',
                  APP_VK_GROUP       = 'https://vk.com/trofix_club/',
                  APP_VK_DEV         = 'https://vk.com/trofim_dm/',
                  APP_KEY            = 'wpRtKPqoP40VDxj_S8xSUaCVJ-MtGnJn',
                  APP_VERSION        = '1.0',
                  APP_VERSION_PREFIX = '';
                  
    /**
     * Загрузка компонента.
     * 
     * @event construct 
     */
    function doConstruct (ScriptEvent $e = null)
    {    
        /*if (count($GLOBALS['argv']) > 1) {
            $args = $GLOBALS['argv'];
            if ($args[1] == '--newversion' && isset($args[2])) {

            }
        }*/
    }
    
    /**
     * Название программы.
     * 
     * @return string
     */
    static function getAppName () : string
    {
        return self::APP_NAME;
    }
    
    /**
     * Репозиторий программы на GitHub.
     * 
     * @return string
     */
    static function getAppGitHub () : string
    {
        return self::APP_GITHUB;
    }
    
    /**
     * Сервер программы.
     * 
     * @return string
     */
    static function getAppServer () : string
    {
        return self::APP_SERVER;
    }
    
    /**
     * Канал YouTube.
     * 
     * @return string
     */
    static function getAppYouTube () : string
    {
        return self::APP_YOUTUBE;
    }
    
    /**
     * Группа VK.
     * 
     * @return string
     */
    static function getAppGroup () : string
    {
        return self::APP_GROUP;
    }
    
    /**
     * Разработчик VK.
     * 
     * @return string
     */
    static function getAppDev () : string
    {
        return self::APP_DEV;
    }
    
    /**
     * Секретный ключ программы.
     * 
     * @return string
     */
    static function getAppKey () : string
    {
        return self::APP_KEY;
    }
    
    /**
     * Версия программы.
     * 
     * @return string
     */
    static function getAppVersion () : string
    {
        return self::APP_VERSION;
    }
    
    /**
     * Префикс версии программы.
     * 
     * @return string
     */
    static function getAppVersionPrefix () : string
    {
        return self::APP_VERSION_PREFIX;
    }
                  
}