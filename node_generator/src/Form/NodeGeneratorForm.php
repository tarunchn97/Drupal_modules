<?php

namespace Drupal\node_generator\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;

class NodeGeneratorForm extends FormBase {
    /**
     * {@inheritdoc}
     */

    public function getFormId() {
        return 'node_generator';

    }
    

    /**
     * {@inheritdoc}
     */
    
    public function buildForm(array $form, FormStateInterface $form_state) {
        $node_types = \Drupal\node\Entity\NodeType::loadMultiple();
        $options = array();
        foreach ($node_types as $node_type) {
            $options[$node_type->id()] = $node_type->label();
        }
        $form['title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#required' => TRUE,
        ];
        $form['nodes'] = [
            '#type' => 'number',
            '#min' => 2,
            '#max' => 10,
            '#title' => $this->t('No of Nodes To Generate'),
            '#required' => TRUE,
        ];
        $form['content'] = [
            '#type' => 'select',
            '#options' => $options,
            '#title' => $this->t('Conent of Type'),
        ];
        $form['text_area'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Body'),
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Generate Nodes'),
        ];
        return $form;

    }

    public function validateForm(array &$form ,FormStateInterface $form_state) {
        $value = $form_state->getvalue('nodes');
        if ($value < 2 || $value > 10 ) {
            $form_state->setErrorByName('node','Node value should be between 2 and 10');        
        }
    }


    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
         $value = $form_state->getvalue('nodes');
         if (intval($value) >=2 && intval($value) <= 10 ) {
            for ($i=0; $i < intval($value) ; $i++) { 
                $node = Node::create(['type' => $form_state->getvalue('content')]);
                $node->set('title' , $form_state->getvalue('title'));
                $node->set('body' , ['value' => $form_state->getvalue('text_area'),'format' => 'basic_html',]);
                $node->enforceIsNew();
                $node->save();

                //      or

                // $node = entity_create('node', array(
                //     'type' => 'article', //$form_state->getvalue('num_2'),
                //     'title' => $form_state->getvalue('Title'),
                //     'body' => array(
                //     'value' => $form_state->getvalue('text_area'),
                //     'format' => 'basic_html',
                //     ),
                //     ));
                // $node->save();

             }
         }
         drupal_set_message($value." Nodes generated successfully");
        
    }
          
  
}