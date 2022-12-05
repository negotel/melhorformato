<?php

/**
 * PONTO DE ENTREGA | FILE THE SITTINGS
 * 
 *  @author Edson Costa
 *  @package Source\Boot 
 */

/**
 * ##################
 * ###  DATABASE  ###
 * ##################
 */
const SET_DB_HOSTNAME = "localhost";
const SET_DB_USERNAME = "root";
const SET_DB_PASSWORD = "";
const SET_DB_NAME = "otimizador";

/**
 * ######################
 * ###  PROJECT URLs  ###
 * ######################
 */
$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https":"http");
$base_url .= "://".$_SERVER['HTTP_HOST'];
$base_url .= substr(str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER["SCRIPT_NAME"]), 0, -1);

define("SET_URL_PRODUCTION", "{$base_url}");
define("SET_URL_TEST", "{$base_url}");

/**
 * ##############
 * ###  VIEW  ###
 * ##############
 */
define("SET_VIEW_PATH", __DIR__ . "/../shared/views");
define("SET_VIEW_EXT", "php");
define("SET_VIEW_THEME", "alpha-v1");


/**
 * SITE
 */
define("CONF_SITE_NAME", "ElApp-Control");
define("CONF_SITE_TITLE", "Controle de Frotas");
define("CONF_SITE_DESC", "...");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "apponlog.com.br");
define("CONF_SITE_ADDR_STREET", "Rua Climaco Barbosa");
define("CONF_SITE_ADDR_NUMBER", "179");
define("CONF_SITE_ADDR_COMPLEMENT", "");
define("CONF_SITE_ADDR_CITY", "São Paulo");
define("CONF_SITE_ADDR_STATE", "SP");
define("CONF_SITE_ADDR_ZIPCODE", "01523-000");

