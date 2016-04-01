<!DOCTYPE html>
<html>
<head>
	<title>FB login</title>
</head>
<body>
<h1>Login using Facebook</h1>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '996700463749753',
      xfbml      : true,
      cookie	 : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));



 function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }


  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      console.log("user access token: "+ response.au);
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }


 function testAPI() {
    console.log('Welcome!  Fetching your information.... ');

    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response + '!| ';


    });
    window.location="./fbtry.php";
  }

</script>


	<p id="status">Not logged in</p>








<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>



</body>
</html>