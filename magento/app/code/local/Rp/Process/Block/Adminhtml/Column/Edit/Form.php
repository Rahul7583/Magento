<?php
class Rp_Process_Block_Adminhtml_Column_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
     
     /*$helper = Mage::helper('process');
     $model = Mage::registry('current_column');*/

     $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array(
                    'id' => $this->getRequest()->getParam('id')
                )),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            ));
    
        /*$fieldset = $form->addFieldset('Group_form', array('legend'=>Mage::helper('process')->__('Column information')));

        
        $fieldset->addField('name', 'text', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'name'
        ));

         $fieldset->addField('required', 'text', array(
            'label' => $helper->__('Required'),
            'required' => true,
            'name' => 'required'
        ));

         $fieldset->addField('casting_type', 'select', array(
         'label' => Mage::helper('process')->__('Casting Type'),
         'name' => 'casting_type',
         'values' => array(
                         array(
                         'value' => 1,
                         'label' => Mage::helper('process')->__('varchar'),
                         ),

                        array(
                         'value' => 2,
                         'label' => Mage::helper('process')->__('int'),
                         ),
                         array(
                         'value' => 3,
                         'label' => Mage::helper('process')->__('decimal'),
                         ),
                    ),
        ));

          $fieldset->addField('exception', 'text', array(
            'label' => $helper->__('Exception'),
            'required' => true,
            'name' => 'exception'
        ));
*/

        $this->setForm($form);
        $form->setUseContainer(true);
        //$form->setValues($model->getData());
        return parent::_prepareForm();

            
    }
}   


