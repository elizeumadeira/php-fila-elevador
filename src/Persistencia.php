<?php

namespace src;

class Persistencia{

    private static $instance = null;
    private function __construct(){}
    private function __clone(){}
    public function __wakeup(){}
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Persistencia();
        }
        return self::$instance;
    }

    public function salvar($data, $fileName): bool
    {
        try{
            $serializedData = serialize($data);
            file_put_contents($fileName, $serializedData);
            
            return true;
        }catch(\Exception $e){
            // alternativamente pode logar $e

            return false;
        }
    }
    
    public function recuperar($filename): ?Object
    {
         try{
           $serializedData = file_get_contents($filename);
            return unserialize($serializedData);
        }catch(\Exception $e){
            throw $e;
        }
    }
    
}