<?php
namespace trofix\scripts;

/**
 * Класс для работы с набором функций.
 * 
 * @author Дмитрий Трофимов
 * @url https://github.com/TROFIM-DM/Trofix-Club
 */
class func 
{
    
    /**
     * Придать изображению закругленность.
     * 
     * @param $node
     * @param int $radius
     */
    public static function setBorderRadiusImage ($node, int $radius)
    {
        $rect = new \php\gui\shape\UXRectangle;
        $rect->width = $node->width;
        $rect->height = $node->height;

        $rect->arcWidth = $radius * 2;
        $rect->arcHeight = $radius * 2;

        $node->clip = $rect;
        $circledImage = $node->snapshot();

        $node->clip = null;
        $rect->free();

        $node->image = $circledImage;
    }
    
}