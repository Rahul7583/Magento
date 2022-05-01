<?php 

class Rp_Process_Block_Adminhtml_Entry_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function selectProcessIDs()
    {
        $finalarray[] = array('value'=>null ,'label'=>'No Process');
        $allGroupIds = Mage::getModel('process/process_entry')->getResource()->getReadConnection()->fetchAll("SELECT `process_id`,`name` FROM `process`");
       
            foreach ($allGroupIds as $data)
            {
                $label = $data['process_id']." => ".$data['name'];
                $array = array('value'=>$data['process_id'] ,'label'=>$label);
                $finalarray[]=$array;
            }
            return $finalarray;
    }            
	protected function 	_prepareForm()
	{
		$helper = Mage::helper('process');
        $model = Mage::registry('current_entry');
     	$form = new Varien_Data_Form();

      $fieldset = $form->addFieldset('entry_form', array('legend'=>Mage::helper('process')->__('Entry Information')));

       $fieldset->addField('process_id', 'select', array(
            'label' => $helper->__('Process Id'),
            'required' => true,
            'name' => 'process_id',
            'values' => $this->selectProcessIDs(),
        ));

        $fieldset->addField('identifier', 'text', array(
            'label' => $helper->__('Identifier'),
            'required' => true,
            'name' => 'identifier'
        ));

        /*$fieldset->addField('start_time', 'date', array(
            'label' => $helper->__('Start Time'),
            'required' => true,
            'name' => 'start_time'
        ));

        $fieldset->addField('end_time', 'date', array(
            'label' => $helper->__('End Time'),
            'required' => true,
            'name' => 'end_time'
        ));*/

        $fieldset->addField('data', 'text', array(
            'label' => $helper->__('Data'),
            'required' => true,
            'name' => 'data'
        ));

        $this->setForm($form);
        $form->setValues($model->getData());
        return parent::_prepareForm();

	}
}	