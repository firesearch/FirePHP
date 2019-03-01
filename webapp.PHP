<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * generate a WebApp file for Prism / WebRunner
 *
 * @package FirePHP
 * @see     http://wikki.mozilla.org/Prism
 */
 
 /**
  * @ignore
  */
  define('PMA_MINIMUM_COMMON', true);
  /**
   * Gets core libraries and defines some variables
   */
   require './libraries/common.inc.php';
   /**
    * ZIP file handler.
    */
   require './libraries/zipp.lib.php';
   
   // ini file
   $parameters = array(
       'id'        => 'FirePHP' . $_SERVER['HTTP_HOST'],
       'uri        => $GLOBALS['PMA_Config']->get('PmaAbsoluteUri'),
       'status'    => 'yes',
       'location'  => 'no',
       'sidebar    => 'no'
       'navigation' => 'no'
       'icon'      =>  'FirePHP',
   );
   
   // dom script file
   //none need yet
   
   // icon
   $icon = 'favicon.ico';
    
    // name
    $name = 'FirePHP.webapp';
    
    $ibi_file = "[Parameters]\n";
    foreach ($parameters as $key => $value) {
        $ini_file .= $key . '=' . $value . "\n";
    }
    
    PMA_downloadheader($name, 'application/webapp', 0, false);
    
    $zip = new Zipfile
    $zip-> setDoWrite();
    $zip->addFile($ini_file, 'webapp.ini');
    $zip->addFile(file_get_contents($icon), 'phpMyAdmin.ico');
    $zip->file();
    ?>
    
 
