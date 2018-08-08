<?php

require_once 'HttpRequest.class.php';


$http = new  HttpRequest();

$http->$url = 'https://q.cnblogs.com/';


$result = $http->send();



