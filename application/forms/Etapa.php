<?php

class Application_Form_Etapa extends Zend_Form
{

    public function init()
    {
        // As definições abaixo são obrigatórias todo formulário deve conter
        $this->setName( 'etapa' );
        $this->setAction( '/etapa/add' );
        $this->setMethod( 'post' );
        
        // As definições abaixo são opcionais e dependem de peculiaridades de seu FORM
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib( 'id', 'form-etapa' );   

        // campos do formulário
        $mes = new Zend_Form_Element_Select( 'mes' );
        $mes->setLabel('Mês')
            ->setRequired( true )
            ->addMultiOptions(
                array(
                    '' => ' - - Escolha o mês - - ', // em branco
                    '1' => 'Janeiro',
                    '2' => 'Fevereiro',
                    '3' => 'Março',
                    '4' => 'Abril',
                    '5' => 'Maio',
                    '6' => 'Junho',
                    '7' => 'Julho',
                    '8' => 'Agosto',
                    '9' => 'Setembro',
                    '10' => 'Outubro',
                    '11' => 'Novembro',
                    '12' => 'Dezembro',
                    )
                )
            ->addErrorMessage('Informe o mês');


        $ano = new Zend_Form_Element_Select( 'ano' );
        $tempoAnos = array();
        for ($i=date('Y') ; $i < date('Y')+10   ; $i++) { 
            $tempoAnos[$i] = $i;    
        }    
        $ano->setLabel('Ano')
            ->addMultiOptions($tempoAnos);

            
        $id = new Zend_Form_Element_Hidden('id');
        $this->addElement($id);

        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel( 'Enviar' );
        $this->addElements(
            array(  $id,
                    $mes,
                    $ano,
                    $submit
            )
        );                  
            
        
    }


}

