<?php

use \Phalcon\Tag;

class SigninController extends BaseController
{
    public function onConstruct()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        Tag::setTitle('Signin');
        $this->assets->collection('extra')->addCss('css/signin.css');
        parent::initialize();
    }

    public function doSigninAction()
    {
        if ($this->security->checkToken() == false) {
            $this->flash->error('Invalid CSRF Token');
            $this->response->redirect("signin/index");
            return;
        }

        $this->view->disable();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = User::findFirstByEmail($email);

        if ($user) {
            if ($this->security->checkHash($password, $user->password)) {
                $this->session->set('id', $user->id);
                $this->session->set('role', $user->role);
                $this->response->redirect("dashboard/index");
                return;
            }
        }

        $this->flash->error('Incorrect Credentials');
        $this->response->redirect("signin/index");
    }

    public function registerAction()
    {
        Tag::setTitle('Register');
        $this->assets->collection('extra')->addCss('css/signin.css');

    }

    public function doRegisterAction()
    {
        if ($this->security->checkToken() == false) {
            $this->flash->error('Invalid CSRF Token');
            $this->response->redirect("signin/register");
            return;
        }

        $this->view->disable();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');

        if ($password != $confirm_password) {
            $this->flash->error("You password do not match.");
            $this->response->redirect("signin/register");
        }

        $user = new User();
        $user->role = 'user';
        $user->email = $email;
//        $user->password = $this->security->hash($password);
        $user->password = $password;
        $result = $user->save();

        if (!$result) {
            $output = [];
            foreach ($user->getMessages() as $message) {
                $output[] = $message;
            }
            $output = implode(',', $output);
            $this->flash->error($output);
            $this->response->redirect("signin/register");
            return;
        }
        echo "YES";
    }
}