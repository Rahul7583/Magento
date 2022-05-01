<?php
class Rp_Process_Block_Adminhtml_Process_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
     
     $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array(
                    'id' => $this->getRequest()->getParam('id')
                )),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            ));
    
        $this->setForm($form);
        $form->setUseContainer(true);
        return parent::_prepareForm();

            
    }
}   



