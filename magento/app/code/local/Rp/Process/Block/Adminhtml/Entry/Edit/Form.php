<?php
class Rp_Process_Block_Adminhtml_Entry_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
     
     /*$helper = Mage::helper('process');
     $model = Mage::registry('current_entry');
*/
     $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array(
                    'id' => $this->getRequest()->getParam('id')
                )),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            ));
    
        /*$fieldset = $form->addFieldset('Group_form', array('legend'=>Mage::helper('process')->__('Column information')));
        
        $fieldset->addField('identifier', 'text', array(
            'label' => $helper->__('Identifier'),
            'required' => true,
            'name' => 'identifier'
        ));

        $fieldset->addField('data', 'text', array(
            'label' => $helper->__('Data'),
            'required' => true,
            'name' => 'data'
        ));*/

    
        $this->setForm($form);
        $form->setUseContainer(true);
        //$form->setValues($model->getData());
        return parent::_prepareForm();

            
    }
}   


