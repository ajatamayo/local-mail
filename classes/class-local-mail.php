<?php
/**
 * Helper class to read localmail.
 */
class Local_Mail {

    /** Singleton *************************************************************/
    private static $instance;

    var $mail;

    /**
     * Main Instance
     *
     * @staticvar   array   $instance
     * @return      The one true instance
     */
    public static function instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self;
            self::$instance->init();
        }
        return self::$instance;
    }

    /* To infinity and beyond */
    function init() {
        $this->mail = isset( $_GET['mail'] ) ? $_GET['mail'] : '/var/mail/ariel';
        $this->session();
    }

    /** Session */
    function session() {

        if ( session_id() === '' ) {
            session_start();
        }
    }

    /** Cleared? */
    function is_cleared() {

        if ( isset( $_GET['clear_all'] ) && 'true' === $_GET['clear_all'] ) {
            return true;
        }
        return false;
    }

    /** Redirect */
    function meta_refresh() {

        if ( $this->is_cleared() ) {
            $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://' . $_SERVER["SERVER_NAME"] : 'https://' . $_SERVER["SERVER_NAME"];
            $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":" . $_SERVER["SERVER_PORT"] : "";
            echo '<meta http-equiv="refresh" content="4; url=' . $url . '">';
        }
    }

    /** Read @mBox */
    function read() {

        /** CLASSES **/
        if ( !class_exists( 'PEAR' ) ) {
            require_once ( 'classes/PEAR-1.9.5/PEAR.php' );
        }

        if ( !class_exists( 'Mail_Mbox' ) ) {
            require_once ( 'classes/Mail/Mbox.php' );
        }

        $fileCleared = false;

        // Clear file?
        if ( $this->is_cleared() ) {
            $handle = fopen( $this->mail, "w" );
            fclose( $handle );
            $fileCleared = true;
        }

        if ( $fileCleared ) {
            echo '<p><em>Cleared.</em></p>';
            return;
        }

        //reads a mbox file
        $mbox   = new Mail_Mbox( $this->mail );
        $mbox->open();
        $count  = $mbox->size();

        if ( 0 == $count ) {
            echo '<p>#EmailZero!</p>';
            return;
        }

        echo "<p style='border-bottom:1px solid #efefef; padding-bottom:8px'>\n";

        printf( '%s email%s %s',
            $count,
            1 == $count ? '' : 's',
            ' [ <strong><a href="?clear_all=true" onclick="return 1;">CLEAR ALL</a></strong> ]'
        );

        echo "</p>\n";

        echo "<div style='height:100%;overflow-y:scroll;padding:0;background-color:#faf9f7;border:1px solid #ccc;'>\n";

        for ( $n = 0; $n < $count; $n++ ) {
            $message    = $mbox->get( $n );
            preg_match( '/Subject: (.*)$/m', $message, $matches );
            $subject    = $matches[1];
            $style      = ( $n % 2 === 0 ) ? 'background-color:#efefef;' : 'background-color:#f9f9f9;';
            $num        = $n + 1;

            echo "<div style='border-top:1px solid #DEDEDE;padding:10px 20px;$style'>";
            echo "<strong>Mail #$num: $subject</strong>\n";
            echo "<pre>$message</pre>\n";
            echo "</div>\n";
        }

        $mbox->close();

        echo "</div>\n";
    }

    /** HTML */
    function output() {
        $fileCleared = false;

        // Clear file?
        if ( $this->is_cleared() ) {
            $handle = fopen( $this->mail, "w" );
            fclose( $handle );
            $fileCleared = true;
        }

        // Read file
        if ( file_exists( $this->mail ) ) {
            $email = file_get_contents( $this->mail ); // String

            if ( $fileCleared )
                echo '<p><em>Cleared.</em></p>';

            if ( $email ) {
                echo '<p style="border-bottom:1px solid #efefef; padding-bottom:8px">';

                if ( is_array( $email) ) {
                    echo count( $email ) . ' email(s)';
                }
                else {
                    preg_match_all( '/(-{2}[a-z0-9]{11}[.])/i', $email, $matches );
                    echo count( $matches[0] ) . ' email(s)';
                }

                echo ' [ <strong><a href="?clear_all=true" onclick="return confirm(\'Are you sure?\');">CLEAR ALL</a></strong> ]';
                echo '</p>' . "\n";

                echo '<div style="height:100%;overflow:scroll;padding:0;background-color:#faf9f7;border:1px solid #ccc;">' . "\n";

                if ( is_array( $email ) ) {
                    $counter = 0;
                    foreach ( $email as $key => $mail ) : $counter++;
                        $style = ( $counter % 2 === 0 ) ? 'background-color:#efefef;' : 'background-color:#f9f9f9;';
                        $mail  = htmlspecialchars( $mail );
                        echo "<pre style='$style'>$mail</pre>\n";
                    endforeach;
                }
                else {

                    $email = htmlspecialchars( $email );

                    $array = preg_split( '/(-{2}[a-z0-9]{11}[.])/i', $email );

                    $counter = 0;
                    foreach ( $array as $key => $mail ) : $counter++;
                        $style = ( $counter % 2 === 0 ) ? 'background-color:#efefef;' : 'background-color:#f9f9f9;';

                        echo "<pre style='border-top:1px solid #DEDEDE;padding:10px 20px;$style'>\n";
                            echo $mail;
                        echo "</pre>\n";
                    endforeach;
                }

                echo '</div>';
            }
            else {
                echo '<p>#EmailZero!</p>';
            }
        }
        else {
            echo '<p><em>There was a problem reading the file.</em></p>';
            var_dump( $this->mail );
        }
    }

}

function LOCAL_MAIL() {
    return Local_Mail::instance();
}

?>