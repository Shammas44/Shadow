<?php
/* ==========================================================================
   Connexion à la DB 
   ========================================================================== */
   
   try
   {
   	$bdd = new PDO('mysql:host=localhost;dbname=shadowdb;charset=utf8', 'root', 'root');
   }
   catch (Exception $e)
   {
   	die('Erreur : ' . $e->getMessage());
   }

