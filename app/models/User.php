<?php

use \Phalcon\Mvc\Model\Behavior\SoftDelete;

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

}