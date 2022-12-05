<?php

/**
 * PONTO DE ENTREGA | FILE THE HELP
 * 
 *  @author Edson Costa
 *  @package Source\Boot 
 */


/**
 * ###############
 * ###   URL   ###
 * ###############
 */

/**
 * @param string $path
 * @return string
 */
function url(string $path = null): string
{

    $path_url = (strpos($_SERVER['HTTP_HOST'], "localhost")) ? SET_URL_TEST : SET_URL_PRODUCTION;
    if ($path) {
        return "{$path_url}/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return SET_URL_PRODUCTION;
}

/**
 * @param string|null $path
 * @param string $theme
 * @return string
 */
function theme(string $path = null, string $theme = SET_VIEW_THEME): string
{

    $path_url = (strpos($_SERVER['HTTP_HOST'], "localhost")) ? SET_URL_TEST : SET_URL_PRODUCTION;
    if ($path) {
        return "{$path_url}/themes/{$theme}/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return "{$path_url}/themes/{$theme}";
}

function createColumnsArray($end_column, $first_letters = '')
{
    $columns = array();
    $length = strlen($end_column);
    $letters = range('A', 'Z');

    // Iterate over 26 letters.
    foreach ($letters as $letter) {
        // Paste the $first_letters before the next.
        $column = $first_letters . $letter;

        // Add the column to the final array.
        $columns[] = $column;

        // If it was the end column that was added, return the columns.
        if ($column == $end_column)
            return $columns;
    }

    // Add the column children.
    foreach ($columns as $column) {
        // Don't itterate if the $end_column was already set in a previous itteration.
        // Stop iterating if you've reached the maximum character length.
        if (!in_array($end_column, $columns) && strlen($column) < $length) {
            $new_columns = createColumnsArray($end_column, $column);
            // Merge the new columns which were created with the final columns array.
            $columns = array_merge($columns, $new_columns);
        }
    }

    return $columns;
}

function month_in_full($month, $ucwords = false)
{
    $month = str_pad($month, 2, '0', STR_PAD_LEFT);
    switch ($month) {
        case 01:
            return ($ucwords) ? ucwords('janeiro') : 'janeiro';
        case 02:
            return ($ucwords) ? ucwords('fevereiro') : 'fevereiro';
        case 03:
            return ($ucwords) ? ucwords('marco') : 'marco';
        case 04:
            return ($ucwords) ? ucwords('abril') : 'abril';
        case 05:
            return ($ucwords) ? ucwords('maio') : 'maio';
        case 06:
            return ($ucwords) ? ucwords('junho') : 'junho';
        case 07:
            return ($ucwords) ? ucwords('julho') : 'julho';
        case 8:
            return ($ucwords) ? ucwords('agosto') : 'agosto';
        case 9:
            return ($ucwords) ? ucwords('setembro') : 'setembro';
        case 10:
            return ($ucwords) ? ucwords('outubro') : 'outubro';
        case 11:
            return ($ucwords) ? ucwords('novembro') : 'novembro';
        case 12:
            return ($ucwords) ? ucwords('dezembro') : 'dezembro';
    }
}

function totalRegistro($v): string
{
    $postData = (new \Source\Models\PreventData())->find('lote = :lote', "lote={$v}")->count();
    return $postData;
}


/**
 * ###################
 * ###   REQUEST   ###
 * ###################
 */

/**
 * @return string
 */
function csrf_input(): string
{
    $session = new \Source\Core\Session();
    $session->csrf();
    return "<input type='hidden' name='csrf' value='" . ($session->csrf_token ?? "") . "'/>";
}

function codigo_input(): string
{
    $session = new \Source\Core\Session();
    $session->csrf();
    return "<input type='hidden' id='codigo' name='codigo' value='" . ($session->csrf_token ?? "") . "'/>";
}


/**
 * @param $request
 * @return bool
 */
function csrf_verify($request): bool
{
    $session = new \Source\Core\Session();
    if (empty($session->csrf_token) || empty($request['csrf']) || $request['csrf'] != $session->csrf_token) {
        return false;
    }
    return true;
}

/**
 * @param string $string
 * @return string
 */
function str_slug(string $string): string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    $slug = str_replace(
        ["-----", "----", "---", "--"],
        "-",
        str_replace(
            " ",
            "-",
            trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
        )
    );
    return $slug;
}

function selected_current($value_current, $value_received, $type = 'selected')
{
    if ($value_current == $value_received) {
        return $type;
    }
    return "";
}

//limpa caracteres de uma string
/**
 * @param $string
 * @return string|string[]
 */
function limpa_caracteres($string)
{
    $table = ['/' => '', '(' => '', ')' => '', '.' => '', ' ' => '', '-' => ''];
    // Traduz os caracteres em $string, baseado no vetor $table
    $string = strtr($string, $table);
    $string = preg_replace('/[,.;:`´^~\'"]/', "", iconv('UTF-8', 'ASCII//TRANSLIT', $string));
    $string = strtolower($string);
    $string = str_replace(" ", "-", $string);
    $string = str_replace("---", "-", $string);
    return $string;
}

function entity($c, string $prefix = 'tb_') :string
{
    return $prefix . mb_strtolower(str_replace('Source\\Models\\', '', $c)) . 's';
}

function geolocalizao_google_maps($address)
{
    $result = [];

    $address = urlencode($address);
    $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyD6CNtCA3B6fGiTWBQy3L4OgHC9GAvmdmE";
    $geocodeResponseData = file_get_contents($googleMapUrl);
    $responseData = json_decode($geocodeResponseData, true);
    if ($responseData['status'] == 'OK') {

        $latitude = isset($responseData['results'][0]['geometry']['location']['lat']) ? $responseData['results'][0]['geometry']['location']['lat'] : "";
        $longitude = isset($responseData['results'][0]['geometry']['location']['lng']) ? $responseData['results'][0]['geometry']['location']['lng'] : "";
        $formattedAddress = isset($responseData['results'][0]['formatted_address']) ? $responseData['results'][0]['formatted_address'] : "";
        $place_id = isset($responseData['results'][0]['place_id']) ? $responseData['results'][0]['place_id'] : "";

        if ($latitude && $longitude && $formattedAddress) {

            $result["address_formatted"] = $formattedAddress;
            $result["place_id"] = $place_id;
            $result["latitude"] = $latitude;
            $result["longitude"] = $longitude;

            return $result;

        } else {
            return false;
        }
    } else {
        echo "ERROR: {$responseData['status']}";
        return false;
    }
}