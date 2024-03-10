<?php

/* initialize system options*/

declare(strict_types=1);

spl_autoload_register(function ($class) {
    
    require __DIR__ . "/src/$class.php";
    
});

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

header("Content-type: text/html; charset=UTF-8");
/* request variable*/
$partsOrig = explode("/", $_SERVER["REQUEST_URI"]);




/*resources paths*/
$prefix = '/index.php?';
$postfix = '&newsID=';

/* assign default values to paths  */
$parts[1] = $partsOrig[1] ?? Null;

/* URL checking */
if ($parts[1] == NULL or $parts[1] == 'index.php') {
    header("Location: /index.php?group=0&newseg=0");
    exit;
    };


$checkURLFirstPart = preg_match('/index.php\?group=[0-9]*&newseg=[0-9]*/', (string) $parts[1]);
$checkURLSecondPart = preg_match('/index.php\?group=[0-9]*&newseg=[0-9]*&newsID=[0-9]*/', (string) $parts[1]);

if (($checkURLFirstPart or $checkURLSecondPart) == !True) {
    http_response_code(404);
	echo "<h3>Ошибка 404</h3><p1>Страница не существует</p1>";
	exit;
};


/* routing */

$urlVar = $partsOrig[1];

$firstIterat = preg_split("/[?]/",$parts[1]);

$secIterat = preg_split("/[=&]/",$firstIterat[1]);

$numbers[1] = $secIterat[1];

$numbers[3] = $secIterat[3];

$newsID = $secIterat[5] ?? Null;

/* initiate objects of other system modules */

/* database connection */

$database = new Database("localhost","galaxy_newspaper", "admin@localhost", "myawesomepass");

/* datamodel */

$gateway = new NewsGateway($database);

/*viewmodels*/

$view = new mainPageView();

$newsView = new showNewsView();

/*controller*/

$controller = new NewsController($gateway,$view,$newsView);

/* pass request to News Controller */

$controller -> processRequest($_SERVER["REQUEST_METHOD"], (int)$numbers[1], (int) $numbers[3],$prefix,$postfix,$newsID);



