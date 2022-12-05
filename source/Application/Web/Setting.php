<?php

namespace Source\Application\Web;


class Setting extends Web
{

    public function index()
    {
        echo $this->view->render('setting', []);
    }
}