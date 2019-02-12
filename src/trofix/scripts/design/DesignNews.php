<?php
namespace trofix\scripts\design;

use framework, trofix, gui, std;

/**
 * Класс для работы с Design списка новостей.
 * 
 * @author Дмитрий Трофимов
 * @url https://github.com/TROFIM-DM/Trofix-Club
 */
class DesignNews
{
    
    /**
     * Добавить новый item в список новостей.
     * 
     * @param array $objectInfo
     */
    static function addItem (array $objectInfo)
    {
        $GUI = new UXPanel();
        $GUI->classes->add('itemNews-panel');
        
        $labelTitle = new UXLabel(TrofixClub::getAppName());
        $labelTitle->wrapText = true;
        $labelTitle->classes->add('itemNews-title');
        
        $labelDate = new UXLabel(TimeHint::getHint($objectInfo['date']));
        $labelDate->classes->add('itemNews-date');
        
        $boxTD = new UXVBox([$labelTitle, $labelDate]);
        
        $imageIcon = new UXImageArea();
        $imageIcon->stretch = true;
        $imageIcon->size = [50, 50];
        Element::loadContentAsync($imageIcon, $objectInfo['photo'], function () use ($imageIcon) {
            func::setBorderRadiusImage($imageIcon, 25);
        });
        
        $boxIcon = new UXVBox([$imageIcon]);
        $boxIcon->classes->add('itemNews-icon');
        
        $boxTop = new UXHBox([$boxIcon, $boxTD]);
        
        $labelText = new UXLabel($objectInfo['text']);
        $labelText->wrapText = true;
        $labelText->width = 400;
        $labelText->classes->add('itemNews-text');
        app()->getForm(MainForm)->observer('width')->addListener(function ($o, $n) use ($labelText) {
                $labelText->width = $n - 40;
        });
        
        $boxAll = new UXVBox([$boxTop, $labelText]);
        
        $GUI->add($boxAll);
        
        /*$buttonInstall = new UXMaterialButton('Установить');
        $buttonInstall->contentDisplay = 'TEXT_ONLY';
        $buttonInstall->focusTraversable = false;
        $buttonInstall->ripplerFill = '#024c94';
        $buttonInstall->position = [0, 20];
        $buttonInstall->size = [88, 32];
        $buttonInstall->rightAnchor = 43;
        $buttonInstall->cursor = 'HAND';
        $buttonInstall->classes->add('itemNews-buttonInstall');
        $buttonInstall->on('action', function (UXEvent $e) use () {
            
        });
        $GUI->add($buttonInstall);
        
        $buttonOther = new UXMaterialButton();
        $buttonOther->contentDisplay = 'GRAPHIC_ONLY';
        $buttonOther->focusTraversable = false;
        $buttonOther->ripplerFill = '#024c94';
        $buttonOther->position = [0, 20];
        $buttonOther->size = [32, 32];
        $buttonOther->rightAnchor = 10;
        $buttonOther->cursor = 'HAND';
        $buttonOther->classes->add('itemNews-buttonOther');
        $urlInfo = $objectInfo['url']['information'];
        $buttonOther->on('action', function (UXEvent $e) use ($urlInfo) {
            $contextMenu = new UXContextMenu();
            
            $menuItem = new UXMenuItem();
            $menuItem->text = 'Подробнее';
            $menuItem->on('action', function (UXEvent $e) use ($urlInfo) {
                browse($urlInfo);
                //app()->form(MainForm)->toast('Происходит редирект...');
            });
            
            $contextMenu->items->add($menuItem);
            $contextMenu->showByNode($e->sender, -88, 35);
        });
        $GUI->add($buttonOther);*/
        
        $item = new UXVBox([new UXSeparator(), $GUI]);
        
        uiLater(function () use ($item) {
            app()->getForm(MainForm)->boxNews->items->add($item);
            if (app()->getForm(MainForm)->boxNews->items->count() == app()->getForm(MainForm)->boxNews->data('count'))
                app()->getForm(MainForm)->preloaderNews->hide();
        });
    }
    
}