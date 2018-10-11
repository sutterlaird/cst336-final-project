<?php

// Uncomment if you want to use logging...need to install composer
// See examples/logging/index.php for more on server side logging with composer
// require_once('../../setup.php');
// $logger->debug($_SERVER['SCRIPT_FILENAME']);
// $logger->debug('POST data:', $_POST);
// $logger->debug('GET data:', $_GET);


echo '<p>$_POST: ';
echo '<pre>';
var_dump($_POST);
echo '</pre>';
echo "</p>";

echo '<p>$_GET: ';
echo '<pre>';
var_dump($_GET);
echo '</pre>';
echo "</p>";

?>

