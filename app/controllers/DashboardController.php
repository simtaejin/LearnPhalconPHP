<?php

use \Phalcon\Tag;

class DashboardController extends BaseController
{
    public function onConstruct()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        Tag::setTitle('Dashboard');
    }
}