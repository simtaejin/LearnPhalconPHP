<?php

use \Phalcon\Tag;

class AdminController extends BaseController
{
    public function indexAction()
    {
        Tag::setTitle('Admin');
        parent::initialize();
    }
}