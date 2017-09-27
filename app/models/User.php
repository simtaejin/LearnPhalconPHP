<?php

use \Phalcon\Mvc\Model\Behavior\SoftDelete;
use \Phalcon\Mvc\Model\Validator;


use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use \Phalcon\Security;

class User extends BaseModel
{
    public function initialize()
    {
        $this->hasMany('id', 'Project', 'user_id');

        $this->addBehavior(
            new softDelete([
                'field' => 'deleted',
                'value' => 1
            ])
        );
    }

    public function validation()
    {
        $this->validate(new Validator\Email([
            'field' => 'email',
            'message' => 'Your email is invalid'
        ]));

        $this->validatae(new Validator\Uniqueness([
            'field' => 'email',
            'message' => 'Your email is already in use'
        ]));

        $this->validate(new Validator\StringLength([
            'field' => 'password',
            'max' => '30',
            'min' => '4',
            'messageMaximum' => 'Your password must be under 30 characters',
            'messageMinimum' => 'Your password must be atleast 4 characters'
        ]));

        if ($this->validationHasFailed()) {
            return false;
        }

        $security = new Security;

        $this->password = $this->security->hash($this->password);
    }

}