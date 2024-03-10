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
$prefix = '/news';
$postfix = '/newsID=';

/* assign default values to paths  */
$parts[1] = $partsOrig[1] ?? Null;
$parts[2] = $partsOrig[2] ?? Null;
$parts[3] = $partsOrig[3] ?? Null;


/* routing */

$uriFirstLevel = preg_match('/news/', (string) $parts[1]);
$uriSecondLevel = preg_match('/group=[0-9]*&newseg=[0-9]*/',(string) $parts[2]);
$uriThridLevel = preg_match('/newsID=[0-9]*/',(string) $parts[3]);

if ( ($parts[1] == NULL or $parts[1] == 'news') and $parts[2] == NULL):
    header("Location: /news/group=0&newseg=0");
    exit;
 elseif ( $uriFirstLevel == True and $uriSecondLevel == True and $parts[3] == Null):

$numbers = preg_split("/[=&]/",$parts[2]);
$newsID = $parts[3] ?? Null;

elseif ( $uriFirstLevel == True and $uriSecondLevel == True and $uriThridLevel == True):

$numbers = preg_split("/[=&]/",$parts[2]);
$newsID = preg_split("/=/",$parts[3])[1];
    
else:
    http_response_code(404);
	echo "<h3>Ошибка 404</h3><p1>Страница не существует</p1>";
	exit;
endif;



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



