<?php


/**
 * provides a "Sidebar" Block.
 * @Block(
 *  id = "blockwithform",
 *  admin_label = @Translation("Sidebar Block"),
 *  category = @Translation("custom block for adding form on the sidebar of a page"),
 * )
 */

namespace Drupal\blockwithform\Plugin\Block;
 
use Drupal\Core\Block\BlockBase;


class SidebarBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */

    public function build() {

        $form = \Drupal::formBuilder()->getForm('Drupal\blockwithform\Form\RadioForm');
 
        return $form;
      }

} 

