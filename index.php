<?php

require_once 'classes/class-local-mail.php';

/**
 * Initiate.
 *
 */
LOCAL_MAIL();

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <?php LOCAL_MAIL()->meta_refresh(); ?>

  <title>Local Mail</title>

  <link rel="icon" type="image/png" href="assets/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="assets/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="assets/favicon-16x16.png" sizes="16x16" />

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="/" class="brand-logo"><?php printf( 'Local Mail <small><em>from</em> <code>%s</code></small>', LOCAL_MAIL()->mail ); ?></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="https://github.com/ajatamayo/local-mail">Fork me on GitHub</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="https://github.com/ajatamayo/local-mail">Fork me on GitHub</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
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
      <?php LOCAL_MAIL()->read(); ?>
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
          <p class="grey-text text-lighten-4">Built by <a class="orange-text text-lighten-3" href="http://austin.passy.co">Austin Passy</a></p>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Styling by <a class="orange-text text-lighten-3" href="http://github.com/ajatamayo">AJ Tamayo</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
