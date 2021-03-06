<?php

class Session {

    public function start_session()
    {
        $session_name = 'session'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id.
        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies.
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
        session_name($session_name); // Sets the session name to the one set above.

        if(!isset($_SESSION)) session_start();
    }

    public function session_destroy()
    {
        session_destroy();
    }

    public function set($key, $value = null)
    {
        if(is_array($key)) {
            foreach($key as $k => $v) {
                $_SESSION[$k] = $v;
            }
        }
        else {
            $_SESSION[$key] = $value;
        }
    }

    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function regenerate_id($del_old = false)
    {
        session_regenerate_id($del_old);
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function flashdata($key)
    {
        $key = 'flashdata_'.$key;
        $value = $this->get($key);
        $this->delete($key);
        return $value;
    }

    public function set_flashdata($key, $value)
    {
        $this->set('flashdata_'.$key, $value);
    }
    
    public function get_session_array() {
        
        return $_SESSION;
        
    }

}

/* End of file php_session.php */
/* Location: ./application/libraries/php_session.php */
