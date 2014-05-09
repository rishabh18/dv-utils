<?php
/**
 * Delhivery
 * @category   Delhivery
 * @package    Delhivery_Lastmile
 * @copyright  Copyright (c) 2014 Delhivery. (http://www.delhivery.com)
 * @license    Creative Commons Licence (CCL)
 * @purpose    Model Class for Pincode   
 */
class Delhivery_Lastmile_Model_Pincode extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('lastmile/pincode');
    }
    /**
     * Function to load pincode details by pincode number
     *
     * @return pincode object
     */		
    public function loadByPin($pincode)
    {
        $resource = Mage::getSingleton('core/resource');
		$readConnection = $resource->getConnection('core_read');
		$query = "SELECT * FROM " . $resource->getTableName('lastmile/pincode')." WHERE pin = $pincode";
		mage::log("$query");
		$data = $readConnection->fetchOne($query);
        return $data;
    }		

}