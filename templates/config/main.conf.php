<?php
if(!isset($cheminWeb)){
	$cheminWeb = $_SERVER['DOCUMENT_ROOT'];
}

require_once($cheminWeb.'/../config/templates.inc.php');
require_once($cheminWeb . '/config/global.conf.php');
if(file_exists($cheminWeb . '/vendor/autoload.php')) {
    require_once($cheminWeb . '/vendor/autoload.php');
}

// Chargement du framework
function autoload_framework($class_name) {
    global $cheminWeb;

    if(!class_exists($class_name) && !trait_exists($class_name)) {
        $class_explode = explode('_', escapeshellcmd(strtolower($class_name)));
        $class_path = "";
        if($class_explode != false) {
            foreach($class_explode as $key => $part) {
                if(!empty($class_name)) {
                    $class_path .= "/";
                }
                $class_path .= $part;
            }
        }

        $file_to_include = $cheminWeb . "/framework/" . $class_path . ".class.php";
        if(file_exists($file_to_include)) {
            include_once($file_to_include);
            return;
        }
    }
}

spl_autoload_register('autoload_framework');

$page = new Page();