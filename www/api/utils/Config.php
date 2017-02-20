<?php

namespace Utils;

class Config
{
    private static $conf;

    public static function init()
    {
        $configuration_file = file_get_contents(ROOT.'/config/env.json');
        if ($configuration_file === false) {
            $configuration_file = file_get_contents(ROOT.'/config/env.json.sample');
        }

        self::$conf = json_decode($configuration_file);
    }

    private static function insertVariable($string)
    {
        if (is_string($string)) {
            return preg_replace_callback('/\{([^}]+)\}/', function ($matches) {
                if ($matches[1] === 'ROOT') {
                    return ROOT;
                }

                return self::get($matches[1]);
            }, $string);
        }

        return $string;
    }

    public static function get($key, $force = false)
    {
        $key_getter = explode('.', $key);
        $value = null;
        foreach ($key_getter as $k) {
            $value = !isset($value) ? self::$conf->$k : $value->$k;
        }

        if (!is_scalar($value) && !is_array($value)) {
            if (!$force) {
                return null;
            } else {
                return json_decode(json_encode($value), true);
            }
        }

        return self::insertVariable($value);
    }
}
