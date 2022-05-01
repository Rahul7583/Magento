<?php 

class Rp_Process_Block_Adminhtml_Process_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form 
{
    protected function getGroupedOptions()
    {
        $model = Mage::getModel('process/process_group');
        $select = $model->getCollection()
                  ->getSelect()
                  ->reset(Zend_Db_Select::COLUMNS)
                  ->columns(['value' => 'process_group_id','label' => 'name'])
                  ->order('name','ASC');
        $groupOptions = $model->getResource()->getReadConnection()->fetchAll($select);
        if ($groupOptions) {
          return $groupOptions;
        }
        return [];
    }

	protected function 	_prepareForm()
	{
		$helper = Mage::helper('process');
     $model = Mage::registry('current_process');
     		$form = new Varien_Data_Form();

      $fieldset = $form->addFieldset('process_form', array('legend'=>Mage::helper('process')->__('process information')));

          $fieldset->addField('group_id', 'select', array(
          'label'     => Mage::helper('process')->__('Group Name'),          
          'name'      => 'group_id',
          'values' => $this->getGroupedOptions(),
        ));


        $fieldset->addField('type_id','select',array(
            'label' => Mage::helper('process')->__('Type Id'),
            'name' => 'type_id',
            'values' => [
                ['value' => Rp_Process_Model_Process::TYPE_ID_IMPORT, 'label' =>Mage::helper('process')->__('Import')],
                ['value' => Rp_Process_Model_Process::TYPE_ID_EXPORT, 'label' =>Mage::helper('process')->__('Export')],
                ['value' => Rp_Process_Model_Process::TYPE_ID_CRON, 'label' =>Mage::helper('process')->__('Cron')],
            ]
        ));

        $fieldset->addField('name', 'text', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'name'
        ));

         $fieldset->addField('per_request_count', 'text', array(
            'label' => $helper->__('Per Request Count'),
            'required' => true,
            'name' => 'per_request_count'
        ));

         $fieldset->addField('request_interval', 'text', array(
            'label' => $helper->__('Request Interval'),
            'required' => true,
            'name' => 'request_interval'
        ));


           $fieldset->addField('file_name', 'text', array(
            'label' => $helper->__('File Name'),
            'required' => true,
            'name' => 'file_name'
        ));

        $this->setForm($form);
           $form->setValues($model->getData());
            return parent::_prepareForm();

	}
}	