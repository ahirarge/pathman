<?php namespace Ahir\Pathman;

use Exception;

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
    public function timeFolders($root)
    {
        // Checking seperation
        if (strpos($root, '/') === false) {
            $root.='/';
        }
        $this->set($root);
        // Create folders
        $folders = explode('-', date(\Config::get('pathman::time-pattern')));
        foreach ($folders as $key) {
            if (\Config::get('pathman::hashing') !== false) {
                $key = hash(\Config::get('pathman::hashing'), $key);
            }
            $root = $root.$key.'/';
            $this->set($root);
        }
        return $root;
    }   

    /**
    * Set Paths
    *
    * @param  string $path
    * @return null
    */
    public function set($path)
    {
        try {
            $this->_create($path);
            $this->_permissions($path);
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
    protected function _create($path)
    {
        # Check directory
        if (!is_dir($path)) {
            try {
                $result = mkdir($path, 0777);
            } catch (Exception $e) {
                $message = 'Creating error: '.$path;                    
                throw new Exception($message);              
            }
        }
    }

    /**
    * Directory Permission
    *
    * @param  string $path
    * @return null
    */
    protected function _permissions($path)
    {
        # Check permissions
        $permission = substr(sprintf('%o', fileperms($path)), -4);
        if ($permission != '0777') {
            try {
                chmod($path, 0777);
            } catch (Exception $e) {
                $message = 'Permission error: '.$path;
                throw new Exception($message);
            }
        }
    }

}