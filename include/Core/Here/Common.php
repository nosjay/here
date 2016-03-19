<?php
/**
 * @author ShadowMan
 * @package Here.Common
 */
class Common {
    const JSON_TO_ARRAY  = 'ARRAY';
    const JSON_TO_OBJECT = 'OBJECT';

    private static $_charSet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    public static function noCache() {
        header('Cache-Control: no-cache');
        header('Pragma: no-cache');
    }

    public static function toJSON($value) {
        if (is_array($value)) {
            return json_encode($value);
        } else if (is_string($value)) {
            return json_encode($value, true);
        }
    }

    public static function jsonTo($source, $from = Common::JSON_TO_ARRAY) {
        switch ($from) {
            case Common::JSON_TO_ARRAY: return json_decode($source, true);
            case Common::JSON_TO_OBJECT: return json_decode($source);
            default: return null;
        }
    }

    public static function pawdEncrypt($pawd, $raw = false) {
//         return strtoupper(md5((substr(sha1($pawd), 7, 15) . "F")));
    }

    public static function randString($length = 8) {
        return substr(self::_shuffleString(), 0, $length);
    }

    private static function _shuffleString() {
        return str_shuffle(self::$_charSet);
    }

    private static function _shuffle(&$var) {
        if (gettype($var) == 'string') {
            $var = str_shuffle($var);
        } else if (gettype($var) == 'array') {
            $var = shuffle($var);
        } else {
            return null;
        }
    }
}

?>