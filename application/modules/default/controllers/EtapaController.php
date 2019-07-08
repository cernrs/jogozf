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
                
                
                $dadosFormulario = $this->getRequest()->getPost();
                
                $oEtapa = new Doctrine_Query();
                $oEtapa->from('Model_Etapa')->where('mes = ?', $dadosFormulario['mes'])->addWhere('ano = ?', $dadosFormulario['ano']);
                $row = $oEtapa->fetchOne();
                               
                if($row){
                    $this->view->msgErro = 'Já existe uma etapa cadastrada neste mês para este ano';
                }else{

                    $oEtapa = new Model_Etapa();

                    $oEtapa->mes = null;
                    $oEtapa->mes = $dadosFormulario['mes'];
                    $oEtapa->ano =  $dadosFormulario['ano'];
                    $oEtapa->save();

                    $this->_redirect( '/etapa/listagem' );              
               }

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

       
    }


    public function listagemAction()
    {
       
       
        $oEtapa = new Doctrine_Query();
    
        $oEtapa->select('e.*, COUNT(d.id) as duplas')
                ->from('Model_Etapa e')
                ->leftJoin('e.Dupla d')
                ->groupBy('e.id, e.mes, e.ano'); 

         //echo $oEtapa->getSqlQuery();
         //die();

       $result = $oEtapa->execute();
       $this->view->etapas = $result;

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

