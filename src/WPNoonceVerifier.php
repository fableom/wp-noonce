<?php

namespace fableom\WPNoonce;

class WPNoonceVerifier extends WPNoonce
{
    /**
     * Verify that a nonce is correct and unexpired with the respect to a specified action
     *
     * @link https://codex.wordpress.org/Function_Reference/wp_verify_nonce
     * @return bool|int    Boolean false if the nonce is invalid. Otherwise, returns an integer with the value of generation
     */
    public function verify_nonce()
    {
        if (null === $this->nonce) {
            return false;
        }
        return wp_verify_nonce($this->nonce, $this->action);
    }

    /**
     * Tests either if the current request carries a valid nonce, or if the current request was referred from an administration screen
     *
     * @link https://codex.wordpress.org/Function_Reference/check_admin_referer
     * @param string $query_arg     Where to look for nonce in the $_REQUEST PHP variable
     * @return bool                 True if if the nonce is sent and valid, otherwise the function dies
     */
    public function verify_admin(string $query_arg = '_wpnonce')
    {
        return check_admin_referer($this->action, $query_arg);
    }

    /**
     * Verifies the AJAX request, to prevent any processing of requests which are passed in by third-party sites or systems.
     *
     * @param string $query_arg    Where to look for nonce in the $_REQUEST PHP variable
     * @param bool $die            Whether to die if the nonce is invalid
     * @return bool                If parameter $die is set to false, this function will return a boolean
     */
    public function verify_ajax(string $query_arg = '', bool $die = true)
    {
        return check_ajax_referer($this->action, $query_arg, $die);
    }
}
