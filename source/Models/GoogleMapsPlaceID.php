<?php

namespace Source\Models;
use \Source\Core\Model;

class GoogleMapsPlaceID extends Model
{
    public function __construct()
    {
        parent::__construct(entity(get_class()), ["id"], [], [], [], "*");
    }
}