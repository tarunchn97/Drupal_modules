<?php

namespace Drupal\blockwithform\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RadioForm extends FormBase {
    /**
     * {@inheritdoc}
     */

    public function getFormId() {
        return 'blockwithform';

    }

    /**
     * {@inheritdoc}
     */
    
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
        ];
        $form['radio'] = [
            '#type' => 'radios',
            '#title' => $this->t('Feedback'),
            '#default_value' => 1,
            '#options' => array(1 => $this->t('Really Bad'),
                                2 => $this->t('Bad'),
                                3 => $this->t('Good'),
                                4 => $this->t('Awosome'),
                                5 => $this->t('Excellent'),
                            ),
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit Response'),
        ];
        return $form;

    }
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $connection = \Drupal\Core\Database\Database::getConnection();
        $connection->insert('blockwithform')->fields(['name' => $form_state->getvalue('name'),'response' => $form_state->getvalue('radio'),'created' => REQUEST_TIME, ])->execute();
        drupal_set_message("Thank You , Your Response will submmited successfully");
    }
}