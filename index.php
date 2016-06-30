<?php

require_once 'classes/class-local-mail.php';

/**
 * Initiate.
 *
 */
LOCAL_MAIL();

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <?php LOCAL_MAIL()->meta_refresh(); ?>

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>

        <div class="main-container">
            <div class="main wrapper clearfix">
                <h3><?php printf( 'Local E-Mail <small><em>from</em> <code>%s</code></small>', LOCAL_MAIL()->mail ); ?></h3>
                <?php LOCAL_MAIL()->read(); ?>
                
                <footer>
                	<p>Built by <a href="http://austin.passy.co">Austin Passy</a></p>
					<a href="https://github.com/thefrosty/local-mail"><img style="position: absolute; top: 0; right: 0; border: 0;" src="forkme.png" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
                </footer>

            </div> <!-- #main -->
        </div> <!-- #main-container -->
    </body>
</html>