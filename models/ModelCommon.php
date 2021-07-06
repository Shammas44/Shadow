<?php
declare (strict_types = 1);
namespace models;

abstract class ModelCommon
{
    private static $_db;
    /**
     * setBdd - instancie la connexion à la bdd
     * @return void
     */
    private static function setBdd()
    {
        self::$_db = new \PDO('mysql:host=localhost;dbname=shadowdb;charset=utf8', 'root', 'root');
        self::$_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
    }
    /**
     * getBdd - récupère la connexion à la bdd
     * @return $_db - la connexion
     */
    public static function getBdd()
    {
        if (self::$_db == null) {
            self::setBdd();
        }
        return self::$_db;
    }
    /**
     * getUrlParam - récupère la valeur d'un paramètre dans l'url
     * @param string $urlParamName - le nom de paramètre à récupérer
     * @return mixed - la valeur du paramètre
     */
    public static function getUrlParam(string $urlParamName)
    {
        $fullUrl = $_SERVER['REQUEST_URI'];
        $url_components = parse_url($fullUrl);
        if (!isset($url_components['query'])) {
            $value[$urlParamName] = 1;
        } else {
            parse_str($url_components['query'], $value);
        }
        $var = isset($value[$urlParamName]) ? $value[$urlParamName] : '';
        return $var;
    }
    /**
     * sanitizeString - Aseptise un string
     * @param string $str
     * @return string  $str
     */
    public static function sanitizeString(string $str): string
    {
        $str = strip_tags($str);
        $str = htmlentities($str, ENT_QUOTES);
        $str = trim($str, " \ $!+-_");
        $str = stripslashes($str);
        return $str;
    }
    /**
     * roundTo - arrondis un nombre
     * @param mixed $sum - la somme à arrondire
     * @param double $precision - la précision souhaitée
     * @return double $result - la somme arrondie
     */
    public static function roundTo($sum, $precision = 0.05): double
    {
        $result = round($sum / $precision) * $precision;
        $integerSeparator = '.';
        $thousandSeparator = "'";
        $result = number_format($result, 2, $integerSeparator, $thousandSeparator);
        return $result;
    }
}
