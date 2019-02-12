<?php
namespace trofix\forms;

use httpclient;
use facade\Json;
use std, gui, framework, trofix;
use trofix\scripts\api\ApiGitHub as ApiGH;
use trofix\scripts\api\ApiVK;

/**
 * Класс формы MainForm.
 * 
 * @author Дмитрий Трофимов
 * @url https://github.com/TROFIM-DM/Trofix-Club
 */
class MainForm extends AbstractForm
{
    
    /**
     * @var Preloader
     */
    public $preloaderApps;
    
    /**
     * @var Preloader
     */
    public $preloaderNews;
    
    /**
     * @event showing 
     */
    function doShowing (UXWindowEvent $e = null)
    {    
        $this->minWidth = 456;
        $this->minHeight = 783;
        
        $this->preloaderApps = new Preloader($this->panelApps);
        $this->preloaderApps->setText('Загрузка приложений...');
        $this->preloaderApps->classes->addAll(['preloader', 'preloaderApps']);
        $this->preloaderApps->style = '-fx-background-color: #f7f7f7;';
        
        $this->preloaderNews = new Preloader($this->panelNews);
        $this->preloaderNews->setText('Загрузка новостей...');
        $this->preloaderNews->classes->addAll(['preloader', 'preloaderNews']);
        $this->preloaderNews->style = '-fx-background-color: #f7f7f7;';
    }
    
    /**
     * @event show 
     */
    function doShow (UXWindowEvent $e = null)
    {    
        func::setBorderRadiusImage($this->buttonProfile, 4);
        
        $this->updateApps();
        $this->updateNews();
    }

    /**
     * @event buttonProfile.click-Left 
     */
    function doButtonProfileClickLeft (UXMouseEvent $e = null)
    {    
        Element::loadContentAsync($e->sender, 'https://pp.userapi.com/c845124/v845124435/dceed/kY-eciKdhhM.jpg', function () use ($e) {
            func::setBorderRadiusImage($e->sender, 15);
        });
    }

    /**
     * @event buttonOther.click-Left 
     */
    function doButtonOtherClickLeft (UXMouseEvent $e = null)
    {    
        $contextMenu = new UXContextMenu();
            
        $menuItem1 = new UXMenuItem();
        $menuItem1->text = 'Проверить обновл. приложений';
        $menuItem1->on('action', function (UXEvent $e) {
            if (is_object($this->btnApps_connect))
                $this->btnApps_connect->free();
            $this->updateApps();
        });
        $contextMenu->items->add($menuItem1);
        
        $menuItem2 = new UXMenuItem();
        $menuItem2->text = 'Проверить обновл. новостей';
        $menuItem2->on('action', function (UXEvent $e) {
            if (is_object($this->btnNews_connect))
                $this->btnNews_connect->free();
            $this->updateNews();
        });
        $contextMenu->items->add($menuItem2);
        
        $contextMenu->items->add(UXMenuItem::createSeparator());
        
        $menuItem3 = new UXMenuItem();
        $menuItem3->text = 'Настройки';
        $menuItem3->on('action', function (UXEvent $e) {
            
        });
        $contextMenu->items->add($menuItem3);
        
        $contextMenu->showByNode($e->sender, -212, 29);
    }
    
    /**
     * Обновление списка приложений.
     */
    function updateApps ()
    {
        $this->preloaderApps->show();
        $this->boxApps->items->clear();
        $this->boxApps->data('count', 0);
         ApiGitHub::getRequest(ApiGH::getMethod('users/repos'), function (array $result) {
            $this->boxApps->data('count', count($result));
            $thread = new Thread(function () use ($result) {
                foreach ($result as $app)
                    DesignApp::addItem(['title' => $app['name'],
                                        'description' => $app['description'],
                                        'icon' => ApiGH::getMethod('ico_program', $app['name']),
                                        'url' => ['information' => $app['html_url'] . '#' . $app['name']]]);
            })->start();
        });
    }
    
    /**
     * Обновление списка новостей.
     */
    function updateNews ()
    {
        $this->preloaderNews->show();
        $this->boxNews->items->clear();
        $this->boxNews->data('count', 0);
         ApiVK::getRequest('wall.get', ['domain' => 'liveexp', 'filter' => 'owner', 'extended' => 1, 'count' => 5, 'fields' => 'photo_50'], function (array $result) {
            $this->boxNews->data('count', count($result['items']));
            $thread = new Thread(function () use ($result) {
                foreach ($result['items'] as $new)
                    DesignNews::addItem(['id' => $new['id'],
                                        'date' => $new['date'],
                                        'photo' => $result['groups'][0]['photo_50'],
                                        'text' => $new['text'],
                                        'comments' => $new['comments'],
                                        'likes' => $new['likes'],
                                        'reposts' => $new['reposts'],
                                        'views' => $new['views']]);
            })->start();
        });
    }
    
}
