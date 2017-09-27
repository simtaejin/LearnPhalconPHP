<?php

use Phalcon\Tag;

class IndexController extends BaseController
{
    public function onConstruct()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        Tag::setTitle('Home');
    }

    public function signoutAction()
    {
        $this->session->destroy();
        $this->response->redirect('index/');
    }

    public function generagePasswordAction($password)
    {
        echo $this->security->hash($password);
    }

    public function startSessionAction()
    {
        $this->session->set('user', [
            'name' => 'Ted',
            'age' => 55,
            'soOn' => 'soForth'
        ]);

        $this->session->set('name', 'Jesse');
    }

    public function getSessionAction()
    {
        $user = $this->session->get('user');
        print_r($user);
        echo $this->session->get('name');
    }

    public function removeSessionAction()
    {
        echo $this->session->remove('name');
    }

    public function destroySessionAction()
    {
        echo $this->session->destroy();
    }
}