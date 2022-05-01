<?php
class Rp_Process_Block_Adminhtml_Process_Upload extends Mage_Adminhtml_Block_Widget_Grid_Container{

    protected function _construct()
    {
        /*echo "block";
        exit();*/
        $this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_process';
        $this->_addButtonLabel = Mage::helper('process')->__('Add File');


        parent::_construct();
    }

    public function getHeaderText()
    {
        // code...
        return "Upload Form";
    }
}    
