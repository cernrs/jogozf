<?php

class Default_EtapaController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
    }

    public function addAction()
    {
        $form = new Application_Form_Etapa();
               
        $dadosFormulario = $this->getRequest()->getPost();
        
        if( $this->getRequest()->isPost() ) {
            
            if( $form->isValid( $dadosFormulario ) ) {  
                
                
                // $dadosFormulario = $this->getRequest()->getPost();
                // $etapas = $this->_db;
                // $select  = $etapas->select()->where('mes = ?', $dadosFormulario['mes'])
                //                             ->where('ano = ?', $dadosFormulario['ano']);
                // $row = $etapas->fetchRow($select);
                
                
                // if($row){

                //     $this->view->msgErro = 'Já existe uma etapa cadastrada neste mês para este ano';

                // }else{
   

                    $oEtapa = new Model_Etapa();

                    $oEtapa->mes = null;
                    $oEtapa->mes = $dadosFormulario['mes'];
                    $oEtapa->ano =  $dadosFormulario['ano'];
                    $oEtapa->save();

                    $this->_redirect( '/etapa/listagem' );              
               // }

            } else {
                $form->populate( $dadosFormulario );
            }
        }
        $this->view->form = $form;

    }

    public function atualizarAction()
    {
        
        $oEtapa = new Doctrine_Query();
        $form = new Application_Form_Etapa();
        $form->setAction('/etapa/atualizar');

        
        if( $this->getRequest()->isPost() ) {
            
                $dadosFormulario = $this->getRequest()->getPost();
                    
                if ( $form->isValid( $dadosFormulario ) && isset($dadosFormulario['id']) ) {  
                    $oEtapa->from('Model_Etapa')->where('id = ?', $dadosFormulario['id']);
                    $oInstanciaEtapa = $oEtapa->fetchOne();

                    $oInstanciaEtapa->mes = $dadosFormulario['mes']; 
                    $oInstanciaEtapa->ano = $dadosFormulario['ano'];

                    $oInstanciaEtapa->save();

        


                $this->_redirect( '/etapa/listagem' );              

            } else {
                $form->populate( $dadosFormulario );
            }

        }else{

            if($this->getRequest()->getParam('id') AND is_numeric($this->getRequest()->getParam('id'))){
                
                $id = $this->getRequest()->getParam('id');
                $oEtapa->from('Model_Etapa')->where('id = ?', $id);
                $row = $oEtapa->fetchOne();
            
                if ($row) {
                    $form->id->setValue($row['id']);
                    $form->mes->setValue($row['mes']);
                    $form->ano->setValue($row['ano']);
                }else{
                    $this->_redirect( '/' );
                }
            
            }else{

                $this->_redirect( '/' );    

            }
        }

        $this->view->form = $form;

    }


    public function listagemAction()
    {
     
    // $etapas = $this->_db->select()
    //                ->from(array('e' => 'etapas'), array('e.id','e.mes','e.ano'))
    //                ->joinLeft(array('p' => 'partidas'), 'e.id = p.id_etapa',  array('duplas' => 'COUNT(p.id_etapa)'))
    //                ->group('e.id')->group('e.mes')->group('e.ano')
    //                ->setIntegrityCheck(false);
                       
    // $result = $this->_db->fetchAll($etapas)->toArray();
    // $this->view->etapas = $result;

    }


    
    public function excluirAction()
    {
        if( $this->getRequest()->getParam('id') ) {

            $id = $this->getRequest()->getParam('id');
            
            $oEtapa = new Doctrine_Query();
            $oEtapa->delete('Model_Etapa')->where('id = ?', $id);
            $oEtapa->execute();
       
            $this->_redirect( '/etapa/listagem' ); 
        }
    }
    
    

}

