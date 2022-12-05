<?php

namespace Source\Application\Web;

use Source\Core\Controller;

/**
 * PONTO DE ENTREGA | Class Web
 * 
 *  @author Edson Costa
 *  @package Source\Application\Web
 */

class Web extends Controller
{

    /** 
     * Application constructor
     */

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../themes/" . SET_VIEW_THEME . "/public/");
    }
}
