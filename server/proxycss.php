<?php
$_REQUEST = array_merge($_GET, $_POST);
require_once('/var/www-ssl/auth/basicauth.php');

$API_KEY = 'cssproxy';

$postText = 'data=' . $_GET['data'];
$language = $_GET['lang'];

if (strcmp($API_KEY, '') != 0)
{
   $postText .= '&key=' . $API_KEY;
}

$url = '/checkDocument/';
$postText .= '&lang=' . $language;

/* this function directly from akismet.php by Matt Mullenweg.  *props* */
function AtD_http_post($request, $host, $path, $port = 80) 
{
   $http_request  = "POST $path HTTP/1.0\r\n";
   $http_request .= "Host: $host\r\n";
   $http_request .= "Content-Type: application/x-www-form-urlencoded\r\n";
   $http_request .= "Content-Length: " . strlen($request) . "\r\n";
   $http_request .= "User-Agent: AtD/0.1\r\n";
   $http_request .= "\r\n";
   $http_request .= $request;

   $response = '';
   $ssl = $port == 443 ? "ssl://" : "";
   if( false != ( $fs = @fsockopen($ssl.$host, $port, $errno, $errstr, 10) ) )
   {
      fwrite($fs, $http_request);

      while ( !feof($fs) )
      {
          $response .= fgets($fs);
      }
      fclose($fs);
      $data = explode("\r\n\r\n", $response, 2);
   }
   else{
      $data = array("","<!-- Error: proxy timed out -->");
   }
   return $data;
}

require("cssencode.php");

$data = AtD_http_post(str_replace("\\'", "'", $postText), "localhost", $url, 443);
header("Content-Type: text/css");
echo encode_css($data[1]);
?>
