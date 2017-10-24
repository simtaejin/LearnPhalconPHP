<?php

namespace Component;

class Helper extends \Phalcon\Mvc\User\Component
{
    public function csrf($redirect = false)
    {
        if ($this->security->checkToken() == false) {
            $this->flash->error('Invalid CSRF Token');
            if ($redirect) {
                    $this->response->redirect($redirect);
            }

            return false;
        }
    }
}