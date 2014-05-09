<?php
/**
 * Delhivery
 * @category   Delhivery
 * @package    Delhivery_Lastmile
 * @copyright  Copyright (c) 2010-2011 Delhivery. (http://www.delhivery.com)
 * @license    Creative Commons Licence (CCL)
 * @purpose    Pincode admin controller actions
 */
class Delhivery_Lastmile_Adminhtml_PincodeController extends Mage_Adminhtml_Controller_Action {

     /**
     * Init Action to specify active menu and breadcrumb of the module
     */    
    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('lastmile/items')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('lastmile/pincode')->load($id);
        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
        }
        Mage::register('pincode_data', $model);
        return $this;
    }
     /**
     * Function to render pincode layout block
     */ 
    public function indexAction() {
        $this->_initAction()
                ->renderLayout();
    }
     /**
     * Loads default grid view of admin module
     */ 
    public function lastmilegridAction() {
        $this->_initAction();
        $this->getResponse()->setBody(
                $this->getLayout()->createBlock('lastmile/adminhtml_pincode_edit_tab_lastmile')->toHtml()
        );
    }

     /**
     * Function to download Delhivery serviceable pincodes
     */		
    public function fetchAction() {
		$apiurl =  Mage::getStoreConfig('carriers/dlastmile/pincode_url');
		$token = Mage::getStoreConfig('carriers/dlastmile/licensekey');
		if($apiurl && $token)
		{
			$path = $apiurl.'json/?token='.$token;		
			/*$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "$path");
			curl_setopt($ch, CURLOPT_FAILONERROR, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			$retValue = curl_exec($ch);
			curl_close($ch);*/
			$retValue = Mage::helper('lastmile')->Executecurl($path,'','');
			$codes = json_decode($retValue);
			//echo "Pincode database updated successfully...";
			$i = 0;
			foreach ($codes->delivery_codes as $item) {
			   $lastmilezip = Mage::getModel('lastmile/pincode')->loadByPin($item->postal_code->pin);
			   $model = Mage::getModel('lastmile/pincode');
			   $data = array();
			   $data['district'] = $item->postal_code->district;
			   $data['pin'] = $item->postal_code->pin;
			   $data['pre_paid'] = $item->postal_code->pre_paid;
			   $data['cash'] = $item->postal_code->cash;
			   $data['pickup'] = $item->postal_code->pickup;
			   $data['cod'] = $item->postal_code->cod;
			   $data['is_oda'] = $item->postal_code->is_oda;
			   $data['state_code'] = $item->postal_code->state_code;
			   $model->setData($data);
			   if($lastmilezip)
			   $model->setId($lastmilezip->getId());
			   $model->save();		        			
			}
			echo "<br />Pincode database updated successfully...";
			Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('lastmile')->__('Pincode Updated Successfully'));
		}
		else
		{
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('lastmile')->__('Please add valid License Key and Gateway URL in plugin configuration'));
		}
		$this->_redirect('*/*/');
    }
     /**
     * Function to export grid rows in CSV format
     */
    public function exportCsvAction() {
        $fileName = 'pincodes.csv';
        $content = $this->getLayout()->createBlock('lastmile/adminhtml_pincode_grid')
                        ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }
     /**
     * Function to export grid rows in XML format
     */
    public function exportXmlAction() {
        $fileName = 'pincodes.xml';
        $content = $this->getLayout()->createBlock('lastmile/adminhtml_pincode_grid')
                        ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }
}