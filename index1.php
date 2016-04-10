<!DOCTYPE html>
<html lang="en">



<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Home - Vritthi</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!-- JS -->
  <script src="js/vendor/oauth.js"></script>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">VRITTHI</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">About Us</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="#">About Us</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="row center">
        <img class="responsive-img" src="img/vritthi-logo.png">
      </div>
<!-- 
      <div class="row center">
        <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light deep-purple">Connect to Vritthi</a>
      </div> -->




      
      <div class="card-panel teal lighten-2 row center">
        <table>
          <tr>
            <a class="waves-effect waves-light" href="hybridauth/hybridauth/login-sample.php?provider=Twitter"><img src="img/sign-in-with-twitter.png" ></a><br>
          </tr>
          <tr>
            <button onclick="doSomething();"><a href="hybridauth/hybridauth/github-login.php?provider=GitHub" id="githubLogin" class="waves-effect waves-light "><img width="158"  src="img/GitHub_Logo.png"></a></button><br>
          </tr>
          <tr>
            <a class="waves-effect waves-light "><img src="img/sign-in-linkedin.png"></a><br>
          </tr>
          <tr>
            <div class="input-field col s4 offset-s4">
              <i class="material-icons prefix">account_circle</i>
              <input id="icon_prefix" type="text" class="validate">
              <label class="black-text" for="icon_prefix">SPOJ User ID</label>
            </div><br>
          </tr>
        </table>
      </div>

      <div class="row center">
        <a href="#" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
      </div>


      
      
      <h1 class="header center orange-text">Starter Template</h1>
      <div class="row center">
        <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
      </div>
      <div class="row center">
        <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
      </div>
      <br><br>

    </div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Speeds up development</h5>

            <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User Experience Focused</h5>

            <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
          </div>
        </div>
      </div>

    </div>
    <br><br>

    <div class="section">

    </div>
  </div>

  <footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script type="text/javascript">
    var github = document.getElementById("githubLogin");
    console.log(github);

    function doSomething () {
      // body...
      console.log("This function does something");

      try{
        OAuth.initialize('_DChAQqD1Wwxky6UpwOUryAewB4')  
      } catch (err) {
        alert('initialize error' + err);
      }
      
      var provider = "github";

      OAuth.popup('github').done(function(github) {
        //make API calls with `facebook`
      }).fail(function(err) {
        //todo when the OAuth flow failed
        alert ('Github error: ' + err);
      });
      
    }
    
  </script>

  </body>
</html>
