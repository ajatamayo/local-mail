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
    <div class="nav-wrapper container"><a id="logo-container" href="/" class="brand-logo"><?php printf( 'Local Mail <small><code>%s</code></small>', LOCAL_MAIL()->mail ); ?></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="https://github.com/ajatamayo/local-mail">Fork me on GitHub</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="https://github.com/ajatamayo/local-mail">Fork me on GitHub</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

  <div class="container">
    <div class="section">
      <h1 class="header"><?php echo LOCAL_MAIL()->email_count_display(); ?></h1>
      <?php if ( LOCAL_MAIL()->email_count() && !LOCAL_MAIL()->is_cleared() ) : ?>
        <a class="waves-effect waves-light btn" href="?clear_all=true" onclick="return 1;"><i class="material-icons right">done_all</i>Clear all</a>
      <?php endif; ?>
    </div>
  </div>

  <div class="container">
    <div class="section">
      <?php LOCAL_MAIL()->read(); ?>
    </div>
  </div>

  <footer class="page-footer orange sticky-footer">
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
