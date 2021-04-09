<?php

namespace App\EventListener;

use Knp\Menu\Util\MenuManipulator;
use Sonata\AdminBundle\Event\ConfigureMenuEvent;

class MenuBuilderListener
{
    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $manipulator = new MenuManipulator();
        $menu = $event->getMenu();
        $child = $menu->addChild('calendar', [
            'label' => 'Calendar',
            'route' => 'app_calendar_calendar',
        ]);
        $manipulator->moveChildToPosition($menu, $child, 0);
    }
}