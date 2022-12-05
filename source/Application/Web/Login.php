<?php

namespace Source\Application\Web;

use Source\Application\Web\Web;
use Source\Models\Award;
use Source\Models\SearchMilhar;
use Source\Models\User;

/**
 * PONTO DE ENTREGA | Class Login
 * 
 *  @author Edson Costa
 *  @package Source\Application\Web 
 */

class Login extends Web
{

    /** 
     * Login constructor
     */

    public function index()
    {
        echo $this->view->render('login/login', []);
    }

    public function register()
    {
        echo $this->view->render('register', []);
    }

    public function forgot_password()
    {
        echo $this->view->render('forgot_password', []);
    }

    public function test(?array $args)
    {
        $tb_user = (new User())->find();

        var_dump($tb_user);
    }
}
