<?php
session_start();
setcookie('user','', time() + 3600, '/');
require '../vendor/autoload.php';
require '../resource/Route/web.php';
require '../resource/Route/webApi.php';

