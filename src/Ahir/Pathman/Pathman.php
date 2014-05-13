<?php namespace Ahir\Pathman;

use Exception;
use Debugbar;

class Pathman {

    /**
    * Defer properties
    */
    protected $defer = true;

    /**
    * Time Folders
    *
    * @param  string $root
    * @return string 
    */
    public static function timeFolders($root)
    {
        // Checking seperation
        if (strpos($root, '/') === false) {
            $root.='/';
        }
        self::set($root);
        // Create folders
        $folders = explode('-', date(\Config::get('pathman::time-pattern')));
        foreach ($folders as $key) {
            if (\Config::get('pathman::hashing') !== false) {
                $key = hash(\Config::get('pathman::hashing'), $key);
            }
            $root = $root.$key.'/';
            self::set($root);
        }
        Debugbar::info('Times folders was created.');
        return $root;
    }   

    /**
    * Set Paths
    *
    * @param  string $path
    * @return null
    */
    public static function set($path)
    {
        try {
            self::_create($path);
            self::_permissions($path);
            return true;            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
    * Directory Create
    *
    * @param  string $path
    * @return null
    */
    protected static function _create($path)
    {
        # Check directory
        if (!is_dir($path)) {
            try {
                $result = mkdir($path, 0777);
            } catch (Exception $e) {
                $message = 'Creating error: '.$path;                    
                Debugbar::error($message);
                throw new Exception($message);              
            }
            Debugbar::info("Directory is created: $path");
        }
    }

    /**
    * Directory Permission
    *
    * @param  string $path
    * @return null
    */
    protected static function _permissions($path)
    {
        # Check permissions
        $permission = substr(sprintf('%o', fileperms($path)), -4);
        if ($permission != '0777') {
            try {
                chmod($path, 0777);
            } catch (Exception $e) {
                $message = 'Permission error: '.$path;
                Debugbar::error($message);
                throw new Exception($message);
            }
            Debugbar::info("Directory permissions is set: $path");
        }
    }

}