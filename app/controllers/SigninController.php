<?php

use \Phalcon\Tag;

class SigninController extends BaseController
{
    public function indexAction()
    {
        Tag::setTitle('Signin');
        $this->assets->collection('extra')->addCss('css/signin.css');
        parent::initialize();
    }
}