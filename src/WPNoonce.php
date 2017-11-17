<?php

namespace fableom\WPNoonce;

abstract class WPNoonce implements WPNoonceInterface
{
    /**
     * @var string
     */
    protected $nonce = null;

    /**
     * @var string|int
     */
    protected $action = (-1);

    /**
     * @var string
     */
    protected $name = '_wpnonce';

    /**
     * return the current nonce value
     *
     * @return string
     */
    public function get_nonce()
    {
        return $this->nonce;
    }

    /**
     * set the nonce value
     *
     * @param string $nonce
     * @return self
     */
    public function set_nonce(string $nonce)
    {
        $this->nonce = $nonce;
        return $this;
    }

    /**
     * return the current action value
     *
     * @return string
     */
    public function get_action()
    {
        return $this->action;
    }

    /**
     * set the action value
     *
     * @param string $action
     * @return self
     */
    public function set_action(string $action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * return the current name value
     *
     * @return string
     */
    public function get_name()
    {
        return $this->name;
    }

    /**
     * set the name value
     *
     * @param string $name
     * @return self
     */
    public function set_name(string $name)
    {
        $this->name = $name;
        return $this;
    }
}
