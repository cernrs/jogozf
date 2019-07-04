<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoload()
    {
        
            $autoloader = new Zend_Application_Module_Autoloader(array(
                    'basePath' => APPLICATION_PATH,
                    'namespace' => ''
            ));
            return $autoloader;
    }


    protected function _initDoctrine()
    {
            
        require_once(APPLICATION_PATH.'/../library/Doctrine.php');
        $this->getApplication()->getAutoloader()->pushAutoloader(array('Doctrine', 'autoload'));
        spl_autoload_register(array('Doctrine', 'modelsAutoload'));

        $doctrineConfig = $this->getOption('doctrine');

        $manager = Doctrine_Manager::getInstance();
        $manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
        $manager->setAttribute(
                Doctrine::ATTR_MODEL_LOADING,
                $doctrineConfig['model_autoloading']
        );

        Doctrine::loadModels($doctrineConfig['models_path']);
        $conn = Doctrine_Manager::connection($doctrineConfig['dsn'], 'doctrine');
        $conn->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, true);

        return $conn;
    }



  

  

}

