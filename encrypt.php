<?php 


// function HASH_PWD($pwd, $cost = 11){
//     $salt = substr(base64_encode(openssl_random_pseudo_bytes(17)),0,22);
//     $salt = str_replace("+", ".", $salt);

//     $p = "$".implode('$', array("2y", str_pad($cost, 2, '0', STR_PAD_LEFT), $salt));
//     return crypt($pwd, $p);
//   }

//   function VALIDATE_PWD($pwd, $hash){
 
//  if(crypt(urlencode($pwd), $hash) == $hash)
//   return true;
//   else
//    return false;
// }

BlowfishService::init();

/**
 * Blowfish password hashing service
 *
 * This class will throw (immediately on load) on PHP versions prior to 5.3.2, which
 * did not support the Blowfish algorithm. (and/or would fall back to DES.)
 *
 * On PHP versions prior to 5.3.7, you should check the return-value of isWeak() and
 * you should not use this password cipher on a production site on these systems.
 *
 * http://www.php.net/security/crypt_blowfish.php
 */
class BlowfishService
{
    const SALT_LENGTH = 16;
    const DEV_URANDOM = '/dev/urandom';
    const MIN_STRONG_PHP_VERSION = '5.3.7';
    const MIN_WEAK_PHP_VERSION = '5.3.2';

    /**
     * @var int cryptographic cost of the Blowfish algorithm
     */
    private $_cost;

    /**
     * @var bool
     * @see isWeak()
     */
    private static $_isWeak;

    /**
     * @param int $cost cost (iteration count) for the underlying Blowfish-based hashing algorithm (range 4 to 31)
     *
     * @throws RuntimeException for invalid $cost
     */
    public function __construct($cost = 10)
    {
        if ($cost < 4 || $cost > 31) {
            throw new RuntimeException("invalid strength - please use a number between 4 and 31");
        }

        $this->_cost = $cost;
    }

    /**
     * @return bool true if the Blowfish algorithm on this PHP installation is weak
     */
    public function isWeak()
    {
        return self::$_isWeak;
    }

    /**
     * Static class initializer, called on load
     */
    public static function init()
    {
        self::$_isWeak = version_compare(PHP_VERSION, self::MIN_STRONG_PHP_VERSION) < 0;

        if (self::$_isWeak && version_compare(PHP_VERSION, self::MIN_WEAK_PHP_VERSION) < 0) {
            throw new RuntimeException("Blowfish encryption is not available on php versions prior to " . self::MIN_WEAK_PHP_VERSION);
        }

        if (@CRYPT_BLOWFISH != 1) {
            if (!function_exists('crypt')) {
                throw new RuntimeException("Blowfish encryption is unsupported on this system");
            }
        }
    }

    /**
     * @param int $length entropy length (in bytes)
     * @return string entropy
     * @throws RuntimeException
     */
    private function getEntropy($length)
    {
        if (function_exists('mcrypt_create_iv')) {
            return mcrypt_create_iv($length);
        }

        if (@is_readable(self::DEV_URANDOM)) {
            $random = fopen(self::DEV_URANDOM, 'rb');

            if ($random) {
                $entropy = fread($random, $length);
                fclose($random);
                return $entropy;
            }
        }

        $entropy = '';

        $seed = mt_rand();

        if (function_exists('getmypid')) {
            $seed .= getmypid();
        }

        while (strlen($entropy) < $length) {
            $seed = sha1(mt_rand() . $seed, true);
            $entropy .= sha1($seed, true);
        }

        return substr($entropy, 0, $length);
    }

    /**
     * @return string a salt compatible with crypt() - configured for the Blowfish algorithm
     */
    public function getSalt()
    {
        return (self::$_isWeak ? '$2a$' : '$2y$')
        . sprintf('%02d', $this->_cost) . '$'
        . strtr(substr(base64_encode($this->getEntropy(self::SALT_LENGTH)), 0, 22), '+', '.');
    }

    /**
     * @param string $password password in plain text
     *
     * @return string encrypted password
     */
    public function hash($password)
    {
        return crypt($password, $this->getSalt());
    }

    /**
     * @param string $password password in plain text
     * @param string $hash hash previously created with hash()
     *
     * @return bool true if the password matches
     */
    public function check($password, $hash)
    {
        return $hash === crypt($password, $hash);
    }
}