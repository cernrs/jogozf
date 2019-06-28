<?php

class Default_EtapaController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_db = new Application_Model_DbTable_Etapa();
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
                $etapas = $this->_db;
                $select  = $etapas->select()->where('mes = ?', $dadosFormulario['mes'])
                                            ->where('ano = ?', $dadosFormulario['ano']);
                $row = $etapas->fetchRow($select);
                
                
                if($row){

                    $this->view->msgErro = 'Já existe uma etapa cadastrada neste mês para este ano';

                }else{
   
                    $dados = array(
                        'id' => null,
                        'mes' => $dadosFormulario['mes'],
                        'ano' => $dadosFormulario['ano'],
                    );
                    $res = $this->_db->insert( $dados );
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
        
        $etapas = $this->_db;
        $form = new Application_Form_Etapa();
        $form->setAction('/etapa/atualizar');

        
        if( $this->getRequest()->isPost() ) {
            
            $dadosFormulario = $this->getRequest()->getPost();
            
            if( $form->isValid( $dadosFormulario ) ) {  
                
                $dados = array(
                    'mes' => $dadosFormulario['mes'],
                    'ano' => $dadosFormulario['ano'],
                );
                $res = $this->_db->update($dados,  array('id = ?' => $dadosFormulario['id'] ));
                $this->_redirect( '/etapa/listagem' );              

            } else {
                $form->populate( $dadosFormulario );
            }

        }else{

            if($this->getRequest()->getParam('id') AND is_numeric($this->getRequest()->getParam('id'))){
                
                $id = $this->getRequest()->getParam('id');
                $select  = $etapas->select()->where('id = ?', $id);
                $row = $etapas->fetchRow($select);
                
                if($row){
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
     
    $etapas = $this->_db->select()
                   ->from(array('e' => 'etapas'), array('e.id','e.mes','e.ano'))
                   ->joinInner(array('p' => 'partidas'), 'e.id = p.id_etapa',  array('duplas' => 'COUNT(*)'))
                   ->group('e.id')->group('e.mes')->group('e.ano')
                   ->setIntegrityCheck(false);
                       
    $result = $this->_db->fetchAll($etapas)->toArray();
    $this->view->etapas = $result;

    }


    public function excluirAction()
    {
        if( $this->getRequest()->getParam('id') ) {
            $id = $this->getRequest()->getParam('id');
            $this->_db->delete( "id = {$id}");
            $this->_redirect( '/etapa/listagem' ); 
        }
    }


}

