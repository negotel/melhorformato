<?php


namespace Source\Core;

use Source\Support\Message;

/**
 * PONTO DE ENTREGA | Class Controller
 * 
 *  @author Edson Costa
 *  @package Source\Core 
 */

class Controller {
    
    /** @var View */
    protected $view;

    /** @var Message*/
    protected $message;

    /**
     * Controller constructor.
     * @param string|null $pathToViews
     */

     public function __construct(string $pathToViews = null) {
         $this->view = new View($pathToViews);
         $this->message = new Message();
     }
}
