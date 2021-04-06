<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;

class StatisticAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'statistics';
    protected $baseRouteName = 'statistics';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->clearExcept(['list'])
            ->add('day', "day/{id}/{date}")
        ;
//        dd($collection);
    }
}