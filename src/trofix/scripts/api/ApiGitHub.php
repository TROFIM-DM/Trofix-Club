<?php
namespace trofix\scripts\api;

use gui, httpclient, trofix;

/**
 * Класс API для GitHub.
 * 
 * @author Дмитрий Трофимов
 * @url https://github.com/TROFIM-DM/Trofix-Club
 */
class ApiGitHub 
{
    
    private const API_URL         = 'https://api.github.com/',
                  API_URL_CONTENT = 'https://raw.githubusercontent.com/',
                  API_USER        = 'TROFIM-DM';
                  
    /**
     * Возвращает метод API с USER.
     * 
     * @param string $method
     * 
     * @return string
     */
    public static function getMethod (string $method, string $repos = false) : string
    {
        switch ($method) {
            case 'users':
                $return = 'users/' . self::API_USER;
            break;
            case 'users/repos':
                $return = 'users/' . self::API_USER . '/repos';
            break;
            case 'ico_program':
                $return = self::API_URL_CONTENT . self::API_USER . '/' . $repos . '/master/docs/ico_program.png';
            break;
        }
        return $return;
    }
    
    /**
     * Выполнить GET запрос к API.
     * 
     * @param string $url
     * @param callable $callback
     */
    public static function getRequest (string $url, callable $callback)
    {
        $httpClient = new HttpClient();
        $httpClient->responseType = 'JSON';
        $httpClient->getAsync(self::API_URL . $url, [], function (HttpResponse $response) use ($callback) {
            if ($response->isSuccess() && is_callable($callback))
                $callback($response->body());
            elseif ($response->isServerError()) {
                $buttonConnect = new UXMaterialButton();
                $buttonConnect->id = 'btnApps_connect';
                $buttonConnect->text = 'Повторить';
                $buttonConnect->position = [146, 404];
                $buttonConnect->width = 150;
                $buttonConnect->cursor = 'HAND';
                $buttonConnect->on('action', function (UXEvent $e) {
                    $e->sender->free();
                    app()->getForm(MainForm)->updateApps();
                });
                app()->getForm(MainForm)->preloaderApps->observer('width')->addListener(function ($o, $n) use ($buttonConnect) {
                    $buttonConnect->x = $buttonConnect->x + (($n - $o) / 2);
                });
                app()->getForm(MainForm)->preloaderApps->observer('height')->addListener(function ($o, $n) use ($buttonConnect) {
                    $buttonConnect->y = $buttonConnect->y + (($n - $o) / 2);
                });
                app()->getForm(MainForm)->preloaderApps->add($buttonConnect);
                
                //app()->getForm(MainForm)->toast('Нет подключения к Интернету...', 3000);
            }
        });
        $httpClient->free();
    }
    
}