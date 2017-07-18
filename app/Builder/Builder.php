<?php
namespace App\Builder;

use App\Builder\widget\FromBuilder;
use App\Builder\widget\TableBuilder;

require_once __DIR__ . '/Common.php';

class Builder
{
    protected static $mount;

    public function __construct()
    {

    }

    public static function forms($object = NULL)
    {
        self::$mount['config'] = $object;

        if (isset(self::$mount['config'])) {
            return new FromBuilder($object);
        } else {
            $configClass = new Config();

            return new FromBuilder($configClass->config);
        }
    }

    public static function tables($object = NULL)
    {
        self::$mount['config'] = $object;

        if (isset(self::$mount['config'])) {
            return new TableBuilder($object);
        } else {
            $configClass = new Config();

            return new TableBuilder($configClass->config);
        }
    }
}