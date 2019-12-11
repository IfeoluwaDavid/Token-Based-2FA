<?php

function url_for($script_path)
{
  // add the leading '/' if not present
  if($script_path[0] != '/')
  {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string="") 
{
  return urlencode($string);
}

function raw_u($string="") 
{
  return rawurlencode($string);
}

function h($string="") 
{
  return htmlspecialchars($string);
}

function error_404() 
{
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500()
{
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location)
{
  header("Location: " . $location);
  exit;
}

function request_is_get() {
	return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function request_is_post() {
	return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function request_is_same_domain()
{
	if(!isset($_SERVER['HTTP_REFERER'])) {
		// No refererer sent, so can't be same domain
		return false;
	} else {
		$referer_host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
		$server_host = $_SERVER['HTTP_HOST'];

		// Uncomment for debugging
		// echo 'Request from: ' . $referer_host . "<br />";
		// echo 'Request to: ' . $server_host . "<br />";

		return ($referer_host == $server_host) ? true : false;
	}
}

function display_errors($errors=array()) 
{
    $output = '';
    if(!empty($errors))
    {
        $output .= "<div class=\"errorFeedback\">";
        foreach($errors as $error)
        {
            $output .= h($error);
        }
        $output .= "</div>";
    }
    return $output;
}

?>
