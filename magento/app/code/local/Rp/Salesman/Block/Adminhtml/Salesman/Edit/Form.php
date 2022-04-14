<?php

class Rp_Salesman_Block_Adminhtml_Salesman_Edit_Form extends Mage_Adminhtml_Block_Widget_Form{

	protected function _prepareForm()
	{
		$helper = Mage::helper('salesman');
        $model = Mage::registry('current_salesman');


        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
                'id' => $this->getRequest()->getParam('id')
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $this->setForm($form);

        $fieldset = $form->addFieldset('salesman_form', array('legend' => $helper->__('salesman info')));
        
        $fieldset->addField('firstName', 'text', array(
            'label' => $helper->__('First Name'),
            'required' => true,
            'name' => 'firstName'
        ));

         $fieldset->addField('lastName', 'text', array(
            'label' => $helper->__('Last Name'),
            'required' => true,
            'name' => 'lastName'
        ));

         $fieldset->addField('email', 'text', array(
            'label' => $helper->__('Email'),
            'required' => true,
            'name' => 'email'
        ));

         $fieldset->addField('mobile', 'text', array(
            'label' => $helper->__('Mobile'),
            'required' => true,
            'name' => 'mobile'
        ));

            $fieldset->addField('status', 'text', array(
            'label' => $helper->__('Status'),
            'required' => true,
            'name' => 'status'
        ));


        $form->setUseContainer(true);

        $form->setValues($model->getData());
        return parent::_prepareForm();
    }
}

