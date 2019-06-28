<?php

class Application_Form_Jogador extends Zend_Form
{

    public function init()
    {
        // As definições abaixo são obrigatórias todo formulário deve conter
        $this->setName( 'jogador' );
        $this->setAction( '/jogador/add' );
        $this->setMethod( 'post' );
        
        // As definições abaixo são opcionais e dependem de peculiaridades de seu FORM
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib( 'id', 'form-jogador' );   

        // campos do formulário
        $nome = new Zend_Form_Element_Text( 'nome' );
        $nome->setLabel( 'Nome' )
            ->setRequired( true )
            ->addValidator( 'NotEmpty' )
            ->addFilter( 'StripTags' )
            ->addFilter( 'StringTrim' )
            ->addErrorMessage('Informe o seu nome');

        $pontuacao = new Zend_Form_Element_Text( 'pontuacao' );
        $pontuacao->setLabel( 'Pontuação' )
                  ->setRequired( true )
                  ->addFilter( 'StripTags' )
                  ->addFilter( 'StringTrim' )
                  ->setValidators(array(new Zend_Validate_Int()))
                  ->addErrorMessage('informe a pontuação inicial, deve ser um valor numérico');


        $id = new Zend_Form_Element_Hidden('id');
        $this->addElement($id);
          
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel( 'Enviar' );
        $this->addElements(
            array(  $id,
                    $nome,
                    $pontuacao,
                    $submit
            )
        );                  
            
        
    }


}

