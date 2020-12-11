<?php
/**
 * index.php gathers http request information to determine which action
 * should be completed. Connects to controllers to complete action.
 */
require __DIR__ . '/connect.php';
require __DIR__ . '/models/subscriber.php';
require_once('./controllers/subscribersController.php');
header('Content-Type: application/json');
$apiStrings = preg_split('@/@', $_SERVER['REQUEST_URI'], NULL, PREG_SPLIT_NO_EMPTY);

$con = connect(); //from connect.php
$subscribersController = new SubscribersController($con);

$paramApi = array_key_exists(1, $apiStrings) ? $apiStrings[1] : null;


if($paramApi === 'subscribers') {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    $paramId = array_key_exists(2, $apiStrings) ? $apiStrings[2] : null;

    if( !is_null($paramId) )
      echo $subscribersController->getSubscriberById($paramId);
    else
      echo $subscribersController->getAllSubscribers();
  }
  else if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    $email                 = $_POST['email'];
    $phone                 = array_key_exists('phone', $_POST) ? $_POST['phone'] : null;
    $f_name                = $_POST['f_name'];
    $l_name                = array_key_exists('l_name', $_POST)? $_POST['l_name'] : null;
    $is_subscribed_email   = $_POST['is_subscribed_email'];
    $is_subscribed_phone   = $_POST['is_subscribed_phone'];
    $tags                  = array_key_exists('tags', $_POST) ? $_POST['tags'] : null;
    
    echo $subscribersController->postSubscriber($email, $phone, $f_name, $l_name, $is_subscribed_email, $is_subscribed_phone, $tags);
  }
} else {
  http_response_code(400); //'Bad Request' - https:// www.php.net/manual/en/function.http-response-code.php
  return json_encode([
      'success'=>false,
      'err'=>'Missing API area specification param']
  );
}
$con->close();
?>