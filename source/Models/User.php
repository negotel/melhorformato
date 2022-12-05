<?php

namespace Source\Models;

use Source\Core\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct(entity(get_class()), ["id"], [], [], [], "*");
    }
}