<?php

require 'facebook_sdk/src/facebook.php';

// Create our Application instance (replace this with your appId and secret).

$environment = $_SERVER['SERVER_NAME'] === 'ec2-184-73-59-185.compute-1.amazonaws.com' ? 'PRD' : 'DEV';

if ($environment === 'PRD') {
    $facebook = new Facebook(array(
      'appId'  => '214126558638696',
      'secret' => '18b50960a265f599101ad3c0b2fba04f',
      'cookie' => true,
      'fileUpload' => true,
    ));
}
else {
    // dev
    $facebook = new Facebook(array(
      'appId'  => '197989656904228',
      'secret' => 'f54258a27f57c0062fa7368e2b696f31',
      'cookie' => true,
      'fileUpload' => true,
    ));
}

$facebook->setFileUploadSupport(true); 


$session = $facebook->getSession();


// login or logout url will be needed depending on current user state.
if ($session) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

?>

<div id="fb-root"></div>
<script type="text/javascript">
  window.fbAsyncInit = function() {
    FB.init({
      appId   : '<?php echo $facebook->getAppId(); ?>',
      //session : <?php echo json_encode($session); ?>, // don't refetch the session when PHP already has it <-- commented out, was causing issues where session authentication did not hold
      status  : true, // check login status
      cookie  : true, // enable cookies to allow the server to access the session
      xfbml   : true // parse XFBML
    });

    // whenever the user logs in, we refresh the page
    FB.Event.subscribe('auth.login', function() {
		//window.location.reload();
		});

	};

  (function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }());
</script>