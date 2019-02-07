<?php
namespace trofix\scripts\api;

use httpclient;

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
            /*else if($response->body()['error'] == 'need_captcha')
                self::getCaptcha($response->body());*/
        });
        $httpClient->free();
    }
}