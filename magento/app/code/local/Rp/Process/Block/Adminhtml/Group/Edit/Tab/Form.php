<?php 

class Rp_Process_Block_Adminhtml_Group_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form 
{
	protected function 	_prepareForm()
	{
        $helper = Mage::helper('process');
        $model = Mage::registry('current_group');
        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset('group_form', array('legend'=>Mage::helper('process')->__('Group Information')));

        $fieldset->addField('name', 'text', array(
        'label' => $helper->__('Name'),
        'required' => true,
        'name' => 'name'
        ));

        $this->setForm($form);
        $form->setValues($model->getData());
        return parent::_prepareForm();

	}
}	