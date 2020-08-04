<?php
session_start();

function getCssFiles()
{
	$array['index'] = '

	<!-- Base CSS -->
	<link rel="stylesheet" type="text/css" href="styles/css/main.css">';

	$array['produit'] = '

	<!-- Base CSS -->
	<link rel="stylesheet" type="text/css" href="styles/css/main.css">';

    $array['shopBasket'] = '

    <!-- Base CSS -->
    <link rel="stylesheet" type="text/css" href="styles/css/main.css">';

	//récupère le nom du fichier actuel sans l'xtension .php
	$current_file_name = basename($_SERVER['PHP_SELF'], ".php");
	echo $array[$current_file_name];
}