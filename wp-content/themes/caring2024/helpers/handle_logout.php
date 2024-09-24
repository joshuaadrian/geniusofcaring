<?php

session_start();
require_once('/nas/content/live/geniusofcaring/wp-load.php');
session_unset();
session_destroy();
wp_logout();

