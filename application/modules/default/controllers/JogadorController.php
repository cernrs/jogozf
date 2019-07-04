<?php

class Default_JogadorController extends Zend_Controller_Action
{
    public function init()
    {

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
                
                $oJogador = new Model_Jogador();

                $oJogador->nome = null;
                $oJogador->nome = $dadosFormulario['nome'];
                $oJogador->pontuacao =  $dadosFormulario['pontuacao'];
                $oJogador->save();

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

        $oJogador = new Doctrine_Query();
        $form = new Application_Form_Jogador();
        $form->setAction('/jogador/atualizar');
        
        if ( $this->getRequest()->isPost() ) {
            
            $dadosFormulario = $this->getRequest()->getPost();
            
            if ( $form->isValid( $dadosFormulario ) && isset($dadosFormulario['id']) ) {  
                
                $oJogador->from('Model_Jogador')->where('id = ?', $dadosFormulario['id']);
                $oInstanciaJogador = $oJogador->fetchOne();

                $oInstanciaJogador->nome = $dadosFormulario['nome']; 
                $oInstanciaJogador->pontuacao = $dadosFormulario['pontuacao'];

                $oInstanciaJogador->save();

                $this->_redirect( '/jogador/listagem' );              

            } else {
                $form->populate( $dadosFormulario );
            }

        }else{

            if($this->getRequest()->getParam('id') AND is_numeric($this->getRequest()->getParam('id'))){
                
                $id = $this->getRequest()->getParam('id');
                $oJogador->from('Model_Jogador')->where('id = ?', $id);
                $row = $oJogador->fetchOne();
            
                if ($row) {

                    $form->id->setValue($row['id']);
                    $form->nome->setValue($row['nome']);
                    $form->pontuacao->setValue($row['pontuacao']);
                } else {

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
        $jogadores = new Doctrine_Query();
        $jogadores->from('Model_Jogador');
        $this->view->jogadores = $jogadores->execute();
    }


    public function excluirAction()
    {
        if( $this->getRequest()->getParam('id') ) {

            $id = $this->getRequest()->getParam('id');
            
            $jogador = new Doctrine_Query();
            $jogador->delete('Model_Jogador')->where('id = ?', $id);
            $jogador->execute();
       
            $this->_redirect( '/jogador/listagem' ); 
        }
    }


}

