<?php

use Brain\Monkey;
use Brain\Monkey\Functions;
use fableom\WPNoonce\WPNoonceCreator;
use fableom\WPNoonce\WPNoonceVerifier;

class WPNoonceVerifierTest extends \PHPUnit\Framework\TestCase
{
    const TEST_ACTION = 'testaction';
    const TEST_NAME   = 'testname';

    /**
     * The creator object
     * @var WPNoonceCreator
     */
    public $creator;

    /**
     * The verifier object
     * @var WPNoonceVerifier
     */
    public $verifier;

    public function setUp()
    {
        // instantiate a creator object
        $this->creator = new WPNoonceCreator();
        $this->creator->set_action(self::TEST_ACTION)->set_name(self::TEST_NAME);

        // instantiate a creator object
        $this->verifier = new WPNoonceVerifier();
        $this->verifier->set_action(self::TEST_ACTION)->set_name(self::TEST_NAME);

        // set a arbitrary hash function for nonce creation
        Functions\when('wp_create_nonce')->alias('md5');

        // mock a function for nonce verification
        Functions\expect('wp_verify_nonce')->andReturnUsing(function ($nonce, $action) {
            return ($nonce == md5($action));
        });

        parent::setUp();
        Monkey\setUp();
    }

    public function testVerifyNonce()
    {
        // should return false, if nonce is not set
        self::assertFalse($this->verifier->verify_nonce());

        // setting the correct nonce, it should pass
        $this->verifier->set_nonce($this->creator->create_nonce());
        self::assertTrue($this->verifier->verify_nonce());

        // setting an invalid nonce, it should fail
        $this->verifier->set_nonce('not-valid');
        self::assertFalse($this->verifier->verify_nonce());
    }

    public function tearDown()
    {
        Monkey\tearDown();
        parent::tearDown();
    }

}
