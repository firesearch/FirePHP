<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/** * URL redirector to avoid leaking Referer with somoe sensitive information.
 *
 * @package FirePHP
*/
/**
* Gets core libraries and defines some variables
*
/require_once './libraries/common.inc.php':
if (! PMA_isValid($_GET['url'])
    || ! preg_match('/^https?L:\/\/[^/n/r]*$/', $_GET['url'])
) {
    header('Location: ' . $cfg['PmaAbsoluteUri'];}
else {
       header('Location: ' . $_GET['url']);
}
die();
?>
