<?PHP 
//require 'src/facebook.php';
//require 'src/facebook.php';
require 'facebook/facebook.php'
@extract($_REQUEST);

Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '172175656133736',
  'secret' => '058f4ac1eba141f7558dd6834ccfc319',

  'cookie' => true
));

$session = $facebook->getSession();

$me = null;
// Session based API call.
if ($session) {
  try {
    $uid = $facebook->getUser();
    $me = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
  }
}

    # let's check if the user has granted access to posting in the wall
    $api_call = array(
        'method' => 'users.hasAppPermission',
        'uid' => $uid,
        'ext_perm' => 'publish_stream'
    );
    $can_post = $facebook->api($api_call);
    if($can_post){
        # post it!
        $facebook->api('/'.$uid.'/feed', 'post', array('message' => 'Saying hello from my Facebook app!'));
        echo 'Posted!';
    } else {
        die('Permissions required!');
    }
		

echo "Hola";
?>