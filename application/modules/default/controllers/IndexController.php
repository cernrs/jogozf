<?php

class Default_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->pageTitle = 'Torneio de Canastra';
        $this->view->contentTitle = 'Págin Inicial';
    }


}

