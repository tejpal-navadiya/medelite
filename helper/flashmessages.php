<?php 
class FlashMessage {

    public static function renderError() {
    	if (!isset($_SESSION['messages']) || !isset($_SESSION['messages']['error']) ) {
            return null;
        }
        $messages = $_SESSION['messages']['error'];
        unset($_SESSION['messages']['error']);
        return $messages;
    }

    public static function renderSuccess() {
    	if (!isset($_SESSION['messages']) || !isset($_SESSION['messages']['success'])) {
            return null;
        }
        $messages = $_SESSION['messages']['success'];
        unset($_SESSION['messages']['success']);
        return $messages;
    }

    public static function error($message) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        }
        $_SESSION['messages']['error'][] = $message;
    }

    public static function success($message) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        }
        $_SESSION['messages']['success'][] = $message;
    }
}
?>