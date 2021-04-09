<?php

/**
 * MyClass Class Doc Comment
 *
 * @category Class
 * @package  MyPackage
 * @author   Elmer Huitz <2014110553@ub.edu.bz>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 */

define('DB_SERVER', '198.57.151.234');
define('DB_USERNAME', 'elmerhui_employ');
define('DB_PASSWORD', 'employme123');
define('DB_NAME', 'elmerhui_employme');
date_default_timezone_set("America/Belize");

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false)
{
  die("ERROR: Could not connect. " . mysqli_connect_error());
}
