<?php 
class Rp_Process_Block_Adminhtml_Column_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{

	protected function 	_prepareForm()
	{
		$helper = Mage::helper('process');
        $model = Mage::registry('current_column');
     	$form = new Varien_Data_Form();

      $fieldset = $form->addFieldset('column_form', array('legend'=>Mage::helper('process')->__('Column Information')));

        $fieldset->addField('process_id', 'select', array(
            'label' => $helper->__('Process Id'),
            'required' => true,
            'name' => 'process_id',
            'values' => $this->selectProcessIDs()
        ));
        $fieldset->addField('name', 'text', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'name'
        ));

         $fieldset->addField('required', 'select', array(
            'label' => $helper->__('Required'),
            'required' => true,
            'name' => 'required',
            'values' => [
                    ['value' => Rp_Process_Model_Process_Column::REQUIRED_YES, 'label' =>Mage::helper('process')->__('YES')],
                    ['value' => Rp_Process_Model_Process_Column::REQUIRED_NO, 'label' =>Mage::helper('process')->__('NO')],
            ]
        ));


         $fieldset->addField('casting_type', 'select', array(
            'label' => $helper->__('Casting Type'),
            'required' => true,
            'name' => 'casting_type',
            'values' => [
                    ['value' => Rp_Process_Model_Process_Column::CASTING_TYPE_VARCHAR, 'label' => Mage::helper('process')->__('VARCHAR')],
                    ['value' => Rp_Process_Model_Process_Column::CASTING_TYPE_INT, 'label' => Mage::helper('process')->__('INT')],
                    ['value' => Rp_Process_Model_Process_Column::CASTING_TYPE_DECIMAL, 'label' => Mage::helper('process')->__('DECIMAL')],
            ]
        ));
         $fieldset->addField('exception', 'select', array(
            'label' => $helper->__('Exception'),
            'required' => true,
            'name' => 'exception',
            'values' => [
                    ['value' => Rp_Process_Model_Process_Column::EXCEPTION_YES, 'label' => Mage::helper('process')->__('YES')],
                    ['value' => Rp_Process_Model_Process_Column::EXCEPTION_NO, 'label' => Mage::helper('process')->__('NO')],
            ]
        ));

        $this->setForm($form);
        $form->setValues($model->getData());
        return parent::_prepareForm();

	}

    public function selectProcessIDs()
    {
        $finalarray[] = array('value'=>null ,'label'=>'No Process');
        $allGroupIds = Mage::getModel('process/process_column')->getResource()->getReadConnection()->fetchAll("SELECT `process_id`,`name` FROM `process`");
       
            foreach ($allGroupIds as $data)
            {
                $label = $data['process_id']." => ".$data['name'];
                $array = array('value'=>$data['process_id'] ,'label'=>$label);
                $finalarray[]=$array;
            }
            return $finalarray;
    }        
}	