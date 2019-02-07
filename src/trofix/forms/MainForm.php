<?php
namespace trofix\forms;

use httpclient;
use facade\Json;
use std, gui, framework, trofix;
use trofix\scripts\api\ApiGitHub as ApiGH;

/**
 * Класс формы MainForm.
 * 
 * @author Дмитрий Трофимов
 * @url https://github.com/TROFIM-DM/Trofix-Club
 */
class MainForm extends AbstractForm
{
    
    /**
     * @event showing 
     */
    function doShowing (UXWindowEvent $e = null)
    {    
        $this->minWidth = 456;
        $this->minHeight = 783;
    }
    
    /**
     * @event show 
     */
    function doShow (UXWindowEvent $e = null)
    {    
        func::setBorderRadiusImage($this->buttonProfile, 4);
        //for ($i = 0; $i <= 10; $i++)
            //DesignApp::addItem(['title' => 'AddonCraft', 'description' => 'Суперское приложение! Скачввава авызад зыв абвабвз пвап вапвапвапвпапапапапв п fdf fdfdfdf sdf sdf dfdfsdfd fsdfsdfdfsd fsd f s Суперское приложение! Скачввава авызад зыв абвабвз пвап вапвапвапвпапапапапв п fdf fdfdfdf sdf sdf dfdfsdfd fsdfsdfdfsd fsd f s Суперское приложение! Скачввава авызад зыв абвабвз пвап вапвапвапвпапапапапв п fdf fdfdfdf sdf sdf dfdfsdfd fsdfsdfdfsd fsd f s Суперское приложение! Скачввава авызад зыв абвабвз пвап вапвапвапвпапапапапв п fdf fdfdfdf sdf sdf dfdfsdfd fsdfsdfdfsd fsd f s Суперское приложение! Скачввава авызад зыв абвабвз пвап вапвапвапвпапапапапв п fdf fdfdfdf sdf sdf dfdfsdfd fsdfsdfdfsd fsd f s', 'icon' => 'res://.data/img/ico-48.png']);
        
        $preloader = new Preloader($this->panelApps);
        $preloader->classes->add('preloader');
        $preloader->style = '-fx-background-color: #f7f7f7;';
        $preloader->setText('Загрузка приложений...');
        $preloader->show();
        
        ApiGitHub::getRequest(ApiGH::getMethod('users/repos'), function (array $result) use ($preloader) {
            foreach ($result as $app)
                DesignApp::addItem(['title' => $app['name'],
                                    'description' => $app['description'],
                                    'icon' => ApiGH::getMethod('ico_program', $app['name']),
                                    'url' => ['information' => $app['html_url'] . '#' . $app['name']]]);
            $preloader->hide();
        });
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

}
