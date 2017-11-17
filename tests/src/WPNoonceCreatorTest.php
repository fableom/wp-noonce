<?php

use Brain\Monkey;
use Brain\Monkey\Functions;
use fableom\WPNoonce\WPNoonceCreator;

class WPNoonceCreatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * The creator object
     * @var WPNoonceCreator
     */
    public $creator;

    public function setUp()
    {
        // instantiate a creator object
        $this->creator = new WPNoonceCreator();
        $this->creator->set_action('testaction')->set_name('testname');

        // set a arbitrary hash function for nonce creation
        Functions\when('wp_create_nonce')->alias('md5');

        // return something for nonce url creation
        Functions\expect('wp_nonce_url')->andReturnUsing(function ($actionurl, $action, $name) {
            return $actionurl . '::' . $action . '::' . $name;
        });

        // return something for nonce field creation
        Functions\expect('wp_nonce_field')->andReturnUsing(function ($action, $name, $referer, $echo) {
            return $action . '::' . $name . ($referer ? '::referer' : '');
        });

        parent::setUp();
        Monkey\setUp();
    }

    public function testCreateNonce()
    {
        $nonce = $this->creator->create_nonce('test');

        // nonce should now be set
        self::assertNotNull($this->creator->get_nonce());

        // instance should have set the returned nonce value
        self::assertEquals($nonce, $this->creator->get_nonce());
    }

    public function testCreateUrl()
    {
        $urlValid   = "http://www.test.com";
        $urlInvalid = "url-invalid";

        // create url's
        $urlCreatedValid   = $this->creator->create_url($urlValid);
        $urlCreatedInvalid = $this->creator->create_url($urlValid);

        // should be set to false if no valid url is passed to method
        self::assertFalse($this->creator->create_url($urlCreatedInvalid));

        // should return the generated url
        self::assertEquals($urlCreatedValid, $urlValid . '::' . $this->creator->get_action() . '::' . $this->creator->get_name());
    }

    public function testCreateField()
    {
        $fieldWithReferer = $this->creator->create_field();
        $fieldNoReferer   = $this->creator->create_field(false);

        // test a field with referer
        self::assertEquals($fieldWithReferer, $this->creator->get_action() . '::' . $this->creator->get_name() . '::' . 'referer');

        // test a field without referer
        self::assertEquals($fieldNoReferer, $this->creator->get_action() . '::' . $this->creator->get_name());
    }

    public function tearDown()
    {
        Monkey\tearDown();
        parent::tearDown();
    }

}
