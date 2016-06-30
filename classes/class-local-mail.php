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
            ?>
            <div class="chip">Cleared<i class="material-icons">done_all</i></div>
            <?php
            return;
        }

        $count = $this->email_count();

        if ( 0 == $count ) {
            return;
        }

        $mbox = new Mail_Mbox( $this->mail );
        $mbox->open();
        $this->email_list( $mbox );
        $mbox->close();
    }

    function email_count() {
        /** CLASSES **/
        if ( !class_exists( 'PEAR' ) ) {
            require_once ( 'classes/PEAR-1.9.5/PEAR.php' );
        }

        if ( !class_exists( 'Mail_Mbox' ) ) {
            require_once ( 'classes/Mail/Mbox.php' );
        }

        //reads a mbox file
        $mbox   = new Mail_Mbox( $this->mail );
        $mbox->open();
        $count  = $mbox->size();

        return $count;
    }

    function email_count_display() {
        $count = $this->email_count();
        if ( $count > 1 ) {
            echo $count . ' emails';
        } elseif ( $count == 1 ) {
            echo $count . ' email';
        } else {
            echo 'No emails!';
        }
    }

    function email_list( $mbox ) {
        $count = $this->email_count();
        ?>
        <ul class="collapsible" data-collapsible="expandable">
            <?php for ( $n = 0; $n < $count; $n++ ) : ?>
                <?php
                    $message    = $mbox->get( $n );
                    preg_match( '/Subject: (.*)$/m', $message, $matches );
                    $subject    = $matches[1];
                    $num        = $n + 1;

                    $split_at = strpos( $message, 'Content-Transfer-Encoding: 8bit' );
                    $split_at += strlen( 'Content-Transfer-Encoding: 8bit' );
                    $headers = substr( $message, 0, $split_at );
                    $body = substr( $message, $split_at );
                ?>
                <li>
                    <div class="collapsible-header"><i class="material-icons">email</i><?php printf( 'Mail #%d: %s', $num, $subject ); ?></div>
                    <div class="collapsible-body">
                        <div class="email-body"><?php echo $body; ?></div>
                        <pre class="grey-text"><?php echo htmlspecialchars( $headers ); ?></pre>
                    </div>
                </li>
            <?php endfor; ?>
        </ul>
        <?php
    }
}

function LOCAL_MAIL() {
    return Local_Mail::instance();
}

?>