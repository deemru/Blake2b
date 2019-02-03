# Blake2b

[![packagist](https://img.shields.io/packagist/v/deemru/blake2b.svg)](https://packagist.org/packages/deemru/blake2b) [![php-v](https://img.shields.io/packagist/php-v/deemru/blake2b.svg)](https://packagist.org/packages/deemru/blake2b) [![travis](https://img.shields.io/travis/deemru/Blake2b.svg?label=travis)](https://travis-ci.org/deemru/Blake2b) [![codacy](https://img.shields.io/codacy/grade/ef999b411d884a69b0c3f491c76afa7b.svg?label=codacy)](https://app.codacy.com/project/deemru/Blake2b/dashboard) [![license](https://img.shields.io/packagist/l/deemru/blake2b.svg)](https://packagist.org/packages/deemru/blake2b)

[Blake2b](https://github.com/deemru/Blake2b) implements [BLAKE2](https://en.wikipedia.org/wiki/BLAKE_(hash_function)) hash function on pure PHP.

- Cryptographically compatible Blake2b
- If you have PHP >= 7.2 with [Sodium](http://php.net/manual/en/book.sodium.php), please use [`sodium_crypto_generichash()`](http://php.net/manual/en/function.sodium-crypto-generichash.php)

## Usage

```php
$blake2b = new Blake2b();
$hash = $blake2b->hash( 'Hello, world!' );
if( $hash !== hex2bin( 'b5da441cfe72ae042ef4d2b17742907f675de4da57462d4c3609c2e2ed755970' ) )
    exit( 1 );
```

## Requirements

- [PHP](http://php.net) >= 5.4

## Installation

Require through Composer:

```json
{
    "require": {
        "deemru/blake2b": "1.0.*"
    }
}
```
