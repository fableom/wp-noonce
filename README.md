# WPNoonce #

**Tested up to:** 4.9  
**Requires at least:** 3.6  
**Stable tag:** 1.0.0

An object oriented wrapper for WordPress nonce handling


## Installation ##

Installation can be done via composer:

```
composer require fableom/wp-noonce
```

## Example Usage ##

### Use the nonce creator ###

```
use fableom\WPNoonceCreator;

//instantiate:
$creator = new WPNoonceCreator();

//set up the object:
$creator->set_action('my_action')->set_name('my_name');

//create a nonce:
$nonce = $creator->create_nonce();

//create a url:
$nonce_url = $creator->create_url('http://www.test.com');

//create a form field:
$nonce_field = $creator->create_field();
```


### Use the nonce verifier ###

```
use fableom\WPNoonceVerifier;

//instantiate:
$verifier = new WPNoonceVerifier();

//set up the object:
$verifier->set_nonce('abcd1234')->set_action('my_action')->set_name('my_name');

//validate a nonce:
$is_valid = $verifier->verify_nonce();

//validate an admin referer:
$is_valid = $verifier->verify_admin();

//validate an ajax request:
$is_valid = $verifier->verify_ajax();
```


## Changelog ##

### 1.0.0 ###
* Initial Release
