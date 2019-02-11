<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

require_once("wp-auth.php");

if($_GET['logout'] == 'true'):

    // call logout script, after logged out of integra, then redirect to this script.
    wp_logout();
    // warning
   	print '<pre>Você não está mais logado.</pre>';
    // send back to your prefered page (integra)
    header('Refresh:1; url=../../integra/', TRUE, 301);

endif;

if(isset($_GET["p"]) and !empty($_GET["p"]) and count($_GET) > 0)
	authenticate();
