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
//        echo $this->api->get('fb')->appId;
        Tag::setTitle('Dashboard');
    }
}