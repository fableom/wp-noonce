<?php

namespace fableom\WPNoonce;

interface WPNoonceInterface
{
    /**
     * return the current nonce value
     *
     * @return string
     */
    public function get_nonce();

    /**
     * set the nonce value
     *
     * @param string $nonce
     * @return self
     */
    public function set_nonce(string $nonce);

    /**
     * return the current action value
     *
     * @return string
     */
    public function get_action();

    /**
     * set the action value
     *
     * @param string $nonce
     * @return self
     */
    public function set_action(string $action);

    /**
     * return the current name value
     *
     * @return string
     */
    public function get_name();

    /**
     * set the name value
     *
     * @param string $nonce
     * @return self
     */
    public function set_name(string $name);
}
