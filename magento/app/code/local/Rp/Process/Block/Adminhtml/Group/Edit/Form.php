<?php
class Rp_Process_Block_Adminhtml_Group_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
     
    /* $helper = Mage::helper('process');
     $model = Mage::registry('current_group');
*/
     $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array(
                    'id' => $this->getRequest()->getParam('id')
                )),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            ));
    
        /*$this->setForm($form);
        $fieldset = $form->addFieldset('Group_form', array('legend'=>Mage::helper('process')->__('Group information')));


        $fieldset->addField('name', 'text', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'name'
        ));*/
            $this->setForm($form);
            $form->setUseContainer(true);
            //$form->setValues($model->getData());
            return parent::_prepareForm();

            
    }
}   


