<?php
namespace trofix\scripts\design;

use trofix, std, gui;

/**
 * Класс для работы с Design списка приложений.
 * 
 * @author Дмитрий Трофимов
 * @url https://github.com/TROFIM-DM/Trofix-Club
 */
class DesignApp
{
    
    /**
     * Добавить новый item в список программ.
     * 
     * @param array $objectInfo
     */
    static function addItem (array $objectInfo)
    {
        $GUI = new UXPanel();
        $GUI->classes->add('itemApp-panel');
        
        $imageIcon = new UXImageArea(UXImage::ofUrl($objectInfo['icon']));
        $imageIcon->stretch = true;
        $imageIcon->size = [42, 42];
        
        $boxIcon = new UXVBox([$imageIcon]);
        $boxIcon->classes->add('itemApp-icon');
        
        $labelTitle = new UXLabel($objectInfo['title']);
        $labelTitle->wrapText = true;
        $labelTitle->classes->add('itemApp-title');
        
        $labelDescription = new UXLabel($objectInfo['description']);
        $labelDescription->wrapText = true;
        $labelDescription->width = 216;
        $labelDescription->classes->add('itemApp-description');
        app()->getForm(MainForm)->observer('width')->addListener(function ($o, $n) use ($labelDescription) {
            if (app()->getForm(MainForm)->width => 456)
                $labelDescription->width = $n - 240;
        }); 
        
        $boxLabel = new UXVBox([$labelTitle, $labelDescription]);
        
        $boxAll = new UXHBox([$boxIcon, $boxLabel]);
        
        $GUI->add($boxAll);
        
        $buttonInstall = new UXMaterialButton('Установить');
        $buttonInstall->contentDisplay = 'TEXT_ONLY';
        $buttonInstall->focusTraversable = false;
        $buttonInstall->ripplerFill = '#024c94';
        $buttonInstall->position = [0, 20];
        $buttonInstall->size = [88, 32];
        $buttonInstall->rightAnchor = 43;
        $buttonInstall->cursor = 'HAND';
        $buttonInstall->classes->add('itemApp-buttonInstall');
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
        $buttonOther->classes->add('itemApp-buttonOther');
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
        $GUI->add($buttonOther);
        
        $item = new UXVBox([new UXSeparator(), $GUI]);
        
        app()->getForm(MainForm)->boxApps->items->add($item);
    }
    
}