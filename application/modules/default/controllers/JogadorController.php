<?php

class Default_JogadorController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_db = new Application_Model_DbTable_Jogador();
    }

    public function indexAction()
    {
    }

    public function addAction()
    {
        $form = new Application_Form_Jogador();
               
        $dadosFormulario = $this->getRequest()->getPost();
        
        if( $this->getRequest()->isPost() ) {
            
            if( $form->isValid( $dadosFormulario ) ) {  
                
                $dados = array(
                    'id' => null,
                    'nome' => $dadosFormulario['nome'],
                    'pontuacao' => $dadosFormulario['pontuacao'],
                );
                $res = $this->_db->insert( $dados );
                
                // Envia email 
                $conteudo = sprintf('
                        Assunto: <STRONG>Novo jogador cadastrado</STRONG><BR>
                        <HR>
                        Nome: <STRONG>%s</STRONG> - (%s)<BR>
                        Pontuação inicial: <STRONG>%d</STRONG><BR>
                        <BR>
                        <BR>
                    '
                    , $dadosFormulario['nome']
                    , $res
                    , $dadosFormulario['pontuacao']
                );

                $to = '4d2643de7a-ca4aa4@inbox.mailtrap.io';
                
                $subject = utf8_decode( "Cadastro de Novo Jogador - Site ");
                $html = "
                    <html>
                    <body>
                        ".$conteudo."
                    </body>
                    </html>
                ";

                $mail = new Zend_Mail('utf-8');                
                $mail->setBodyHtml( $html );
                $mail->setFrom( "cern00.bg@gmail.com", "Carlos Eduardo" );
                $mail->addTo( $to, 'Contato Site');
                $mail->setSubject( $subject );
                $mail->send();
                
                $this->_redirect( '/jogador/listagem' );              

            } else {
                $form->populate( $dadosFormulario );
            }
        }

        $this->view->form = $form;
    }

    public function atualizarAction()
    {
        
        $jogadores = $this->_db;
        $form = new Application_Form_Jogador();
        $form->setAction('/jogador/atualizar');

        
        if( $this->getRequest()->isPost() ) {
            
            $dadosFormulario = $this->getRequest()->getPost();
            
            if( $form->isValid( $dadosFormulario ) ) {  
                
                $dados = array(
                    'nome' => $dadosFormulario['nome'],
                    'pontuacao' => $dadosFormulario['pontuacao'],
                );
                $res = $this->_db->update($dados,  array('id = ?' => $dadosFormulario['id'] ));
                $this->_redirect( '/jogador/listagem' );              

            } else {
                $form->populate( $dadosFormulario );
            }

        }else{

            if($this->getRequest()->getParam('id') AND is_numeric($this->getRequest()->getParam('id'))){
                
                $id = $this->getRequest()->getParam('id');
                $select  = $jogadores->select()->where('id = ?', $id);
                $row = $jogadores->fetchRow($select);
                
                if($row){
                    $form->id->setValue($row['id']);
                    $form->nome->setValue($row['nome']);
                    $form->pontuacao->setValue($row['pontuacao']);
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
        $jogadores = $this->_db->fetchAll();
        $this->view->jogadores = $jogadores;

    }


    public function excluirAction()
    {
        if( $this->getRequest()->getParam('id') ) {
            $id = $this->getRequest()->getParam('id');
            $this->_db->delete( "id = {$id}");
            $this->_redirect( '/jogador/listagem' ); 
        }
    }


}

