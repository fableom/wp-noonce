<?php

namespace fableom\WPNoonce;

class WPNoonceCreator extends WPNoonce
{
    /**
     * Generates and returns a nonce
     *
     * @return string   The one use form token.
     */
    public function create_nonce()
    {
        if (null === $this->nonce) {
            $nonce = wp_create_nonce($this->action);
            $this->set_nonce($nonce);
        }
        return $this->nonce;
    }

    /**
     * Creates a URL with nonce added to URL query
     *
     * @param string $actionurl  URL to add nonce action
     * @return string            URL with nonce action added.
     */
    public function create_url(string $actionurl)
    {
        if (!filter_var($actionurl, FILTER_VALIDATE_URL)) {
            return false;
        }
        return wp_nonce_url($actionurl, $this->action, $this->name);
    }

    /**
     * Retrieves the nonce hidden form field.
     *
     * @param bool $referer  Whether also the referer hidden form field should be created
     * @return string        The nonce hidden form field, optionally followed by the referer hidden form field if the $referer argument is set to true
     */
    public function create_field(bool $referer = true)
    {
        // it's not a good idea to let a class member echo output
        $echo = false;
        return wp_nonce_field($this->action, $this->name, $referer, $echo);
    }
}
