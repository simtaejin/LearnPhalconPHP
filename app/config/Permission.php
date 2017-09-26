<?php

use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Acl;

class Permission extends \Phalcon\Mvc\User\Plugin
{
    protected $_publicResources = [
        'index' => '*',
        'signin' => '*'
    ];

    protected $_userResources = [
        'dashboard' => ['*']
    ];

    protected $_adminResources = [
        'admin' => ['*']
    ];

    protected function _getAcl()
    {
        if (!isset($this->persistent->acl)) {
            $acl = new \Phalcon\Acl\Adapter\Memory();
            $acl->setDefaultAction(Phalcon\Acl::DENY);

            $roles = [
                'guest' => new \Phalcon\Acl\Role('guest'),
                'user' => new \Phalcon\Acl\Role('user'),
                'admin' => new \Phalcon\Acl\Role('admin'),
            ];

            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            foreach ($this->_publicResources as $resource => $action) {
                $acl->addResource(new \Phalcon\Acl\Resource($resource), $action);
            }

            foreach ($this->_userResources as $resource => $action) {
                $acl->addResource(new \Phalcon\Acl\Resource($resource), $action);
            }

            foreach ($this->_adminResources as $resource => $action) {
                $acl->addResource(new \Phalcon\Acl\Resource($resource), $action);
            }

            foreach ($roles as $role) {
                foreach ($this->_publicResources as $resource => $action) {
                    $acl->allow($role->getName(), $resource, '*');
                }
            }

            foreach ($this->_userResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow('user', $resource, $action);
                    $acl->allow('admin', $resource, $action);
                }
            }

            foreach ($this->_adminResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow('admin', $resource, $action);
                }
            }

            $this->persistent->acl = $acl;
        }

        return $this->persistent->acl;
    }

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
//        $this->session->destroy();

        $role = $this->session->get('role');
        if (!$role) {
            $role = 'guest';
        }

        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        $acl = $this->_getAcl();
        $allowed = $acl->isAllowed($role, $controller, $action);

        if ($allowed != Phalcon\Acl::ALLOW) {
            $this->flash->error("You do not have permission to access this area.");
            $this->response->redirect('index');
            /*
            $dispatcher->forward([
                'controller' => 'index',
                'action' => 'index'
            ]);
            */
            return false;
        }
    }

}