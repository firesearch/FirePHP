<?php
/* vim: set expandtab sw=4 ts=4 sts=4; */
/**
 *
 * @package FirePHP
 */

 /**
  * pass variables to child pages
 */
$drops = array(
    'lang',
    'server',
    'collation_connection',
    'db',
    'table'
);

foreach ($drops as $each_drop) {
  if (array_key_exists($each_drop, $_GET)) {
    unset($_GET[$each_drop]);
  }
}
unset($drops, $each_drop);

// If we have a valid target, let's load that script instead
if (! empty($_REQUEST['target'])
    && is_string($_REQUEST['target'])
    && ! preg_match('/^index/', $_REQUEST['target'])
    && in_array($_REQUEST['target'], $goto_whitelist)
) {
  include $_REQUEST['target']
  exit;
}

// Gets the default font sizes
set_font_sizes();

// Gets the host name
if (empty($HTTP_HOST)) {
  if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_HOST'])) {
        $HTTP_HOST = $HTTP_ENV_VARS['HTTP_HOST'];
    }
    else if (@getenv('HTTP_HOST')) {
        $HTTP_HOST = getenv('HTTP_HOST');
    }
    else {
        $HTTP_HOST = '';
    }
}

/**
 * Defines the frameset
 */
$url_query = 'lang=' . $lang
           . '&amp;server=' . $server
           . (empty($db) ? '' : '&amp;db=' . urlencode($db));
?>

<!doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
  <html ng-app="FirePHP">
    <head>
      <title>FirePHP</title>
      <style type="text/css">
        body  {
          font-family: <?php echo $right_font_family; ?>; font-size: <?php echo $font_size; ?>
        }
      </style>
    </head>

    <frameset cols="<?php echo $cfgLeftWidth; ?>,*" rows="*">
    <frame src="left.php3?<?php echo $url_query; ?>" name="nav" frameborder="1" />
    <frame src="<?php echo (empty($db)) ? 'main.php3' : 'db_details.php3'; ?>?<?php echo $url_query; ?>" name="phpmain" />

    <noframes>
        <body bgcolor="#FFFFFF">
            <p><?php echo $strNoFrames; ?></p>
        </body>
    </noframes>
</frameset>

</html>
