<?php 

class Rp_Process_Block_Adminhtml_Process_Upload_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form 
{
	/*protected function _prepareForm()
	{
      $helper = Mage::helper('process');
      $model = Mage::registry('current_process_media');
      $form = new Varien_Data_Form();

      $fieldset = $form->addFieldset('upload_form', array('legend'=>Mage::helper('process')->__('Upload information')));



      $fieldset->addField('choose_file', 'file', array(
      'label' => $helper->__('Choose File'),
      'required' => true,
      'name' => 'choose_file'
      ));

      $this->setForm($form);
      //$form->setValues($model->getData());
      return parent::_prepareForm();

	}
      /**/
      protected function _prepareForm()
      {
            $form = new Varien_Data_Form();
            $this->setForm($form);
            $fieldset = $form->addFieldset('process_form', array('legend'=>Mage::helper('process')->__('Process information')));

            $fieldset->addField('fileName', 'file', array(
            'label' => Mage::helper('process')->__('File'),
            'class' => 'required-entry',
            'name' => 'fileName',
            ));

            if ( Mage::getSingleton('adminhtml/session')->getProData() )
            {
                  $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
                  Mage::getSingleton('adminhtml/session')->setProData(null);
                  } elseif ( Mage::registry('current_process_media') ) {
                  $form->setValues(Mage::registry('current_process_media')->getData());
            }
            return parent::_prepareForm();
      }
}	