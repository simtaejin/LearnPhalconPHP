<?php

use \Phalcon\Tag;

class AdminController extends BaseController
{
    public function onConstruct()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        Tag::setTitle('Admin');
    }
}