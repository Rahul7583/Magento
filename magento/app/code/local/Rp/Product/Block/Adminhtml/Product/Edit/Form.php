<?php

class Rp_Product_Block_Adminhtml_Product_Edit_Form extends Mage_Adminhtml_Block_Widget_Form{

	protected function _prepareForm()
	{
		$helper = Mage::helper('product');
        $model = Mage::registry('current_product');


        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
                'id' => $this->getRequest()->getParam('id')
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $this->setForm($form);

        $fieldset = $form->addFieldset('product_form', array('legend' => $helper->__('product info')));
        
        $fieldset->addField('name', 'text', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'name'
        ));

         $fieldset->addField('sku', 'text', array(
            'label' => $helper->__('Sku'),
            'required' => true,
            'name' => 'sku'
        ));

         $fieldset->addField('price', 'text', array(
            'label' => $helper->__('Price'),
            'required' => true,
            'name' => 'price'
        ));

           $fieldset->addField('quantity', 'text', array(
            'label' => $helper->__('Quantity'),
            'required' => true,
            'name' => 'quantity'
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

