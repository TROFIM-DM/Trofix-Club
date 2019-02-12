<?php
namespace trofix\scripts\api;

use gui, httpclient, trofix;

/**
 * Класс API для VK.
 * 
 * @author Дмитрий Трофимов
 * @url https://github.com/TROFIM-DM/Trofix-Club
 */
class ApiVK 
{

    private const API_URL     = 'https://api.vk.com/',
                  API_GROUP   = 'trofix_club',
                  API_VERSION = '5.92';
                  
    private static $access_token = 'f6514007f8aeec580150a398ee30224495a790292d0bdfe89b33d1ffb22844fab6b514b40eb5642424ec3';
    
    /**
     * Короткое имя сообщества.
     * 
     * @return string
     */
    static function getGroup () : string
    {
        return self::API_GROUP;
    }
    
    /**
     * Выполнить GET запрос к API.
     * 
     * @param string $method
     * @param array $params
     * @param callable $callback
     */
    public static function getRequest (string $method, array $params, callable $callback)
    {
        $httpClient = new HttpClient();
        $httpClient->responseType = 'JSON';
        $params['access_token'] = self::$access_token;
        $params['v'] = self::API_VERSION;
        $httpClient->getAsync(self::API_URL . 'method/' . $method, $params, function (HttpResponse $response) use ($callback) {
            if ($response->isSuccess() && is_callable($callback) && isset($response->body()['response']))
                $callback($response->body()['response']);
            elseif ($response->isServerError()) {
                $buttonConnect = new UXMaterialButton();
                $buttonConnect->id = 'btnNews_connect';
                $buttonConnect->text = 'Повторить';
                $buttonConnect->position = [146, 404];
                $buttonConnect->width = 150;
                $buttonConnect->cursor = 'HAND';
                $buttonConnect->on('action', function (UXEvent $e) {
                    $e->sender->free();
                    app()->getForm(MainForm)->updateNews();
                });
                app()->getForm(MainForm)->preloaderNews->observer('width')->addListener(function ($o, $n) use ($buttonConnect) {
                    $buttonConnect->x = $buttonConnect->x + (($n - $o) / 2);
                });
                app()->getForm(MainForm)->preloaderNews->observer('height')->addListener(function ($o, $n) use ($buttonConnect) {
                    $buttonConnect->y = $buttonConnect->y + (($n - $o) / 2);
                });
                app()->getForm(MainForm)->preloaderNews->add($buttonConnect);
                
                //app()->getForm(MainForm)->toast('Нет подключения к Интернету...', 3000);
            }
        });
        $httpClient->free();
    }
}