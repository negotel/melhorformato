<?php

namespace Source\Core;

/**
 * PONTO DE ENTREGA | Class Connect [ Singleton Pattern ]
 * 
 *  @author Edson Costa
 *  @package Source\Core 
 */

class Connect
{
    /** @const array */
    private const OPTIONS = [
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_CASE => \PDO::CASE_NATURAL
    ];

    /** @var \PDO */
    private static $instance;

    /**
     * @return \PDO
     */
    public static function getInstance(): ?\PDO
    {
        if (empty(self::$instance)) {
            try {
                self::$instance = new \PDO(
                    "mysql:host=" . SET_DB_HOSTNAME . ";dbname=" . SET_DB_NAME,
                    SET_DB_USERNAME,
                    SET_DB_PASSWORD,
                    self::OPTIONS
                );
            } catch (\PDOException $exception) {
                redirect("/ops/problemas");
            }
        }

        return self::$instance;
    }

    /**
     * Connect constructor.
     */
    final private function __construct()
    {
    }

    /**
     * Connect clone.
     */
    final private function __clone()
    {
    }
}
