<?php

namespace openpayau\openpaylaravel\lib\Openpay\Api;

/**

 * Class NewOnlineOrder

 *

 * Call 1 - New Online Order

 *

 * @package OpenPay\Api

 

 response :

 The json data will contain:

 

 Element           Format          Notes

 Status             Int            0 – Successful >0 – Error Code

 Reason             Chars          A description of why it was unsuccessful.

 PlanID             BigInt (13)    A 13 digit number representing the Plan ID that can be used in the subsequent order

 EncryptedPlanID    Chars          Future Use: Encrypted version of Plan ID, which should be used for secure Plan related communications.

 */

class NewOnlineOrder extends \openpayau\openpaylaravel\lib\Openpay\Core\ApiConnection

{

	//making the api body with parameters in xml format

	private function _prepareXmldocument(){

	    $this->xml = new \SimpleXMLElement('<NewOnlineOrder/>'); 

	    $this->xml->addChild('JamAuthToken', $this->jamtoken );

	    $this->xml->addChild('PurchasePrice', $this->PurchasePrice);

	    $this->xml->addChild('PlanCreationType', 'Pending');
	    $this->xml->addChild('RetailerOrderNo', $this->PostValues['RetailerOrderNo']);
	    $this->xml->addChild('ChargeBackCount', $this->PostValues['ChargeBackCount']);
	    $this->xml->addChild('CustomerQuality', $this->PostValues['CustomerQuality']);
	    $this->xml->addChild('FirstName', $this->PostValues['FirstName']);
	    $this->xml->addChild('OtherNames', $this->PostValues['OtherNames']);
	    $this->xml->addChild('FamilyName', $this->PostValues['FamilyName']);
	    $this->xml->addChild('Email', $this->PostValues['Email']);
	    $this->xml->addChild('DateOfBirth', $this->PostValues['DateOfBirth']);
	    $this->xml->addChild('Gender', $this->PostValues['Gender']);
	    $this->xml->addChild('PhoneNumber', $this->PostValues['PhoneNumber']);
	    $this->xml->addChild('ResAddress1', $this->PostValues['ResAddress1']);
	    $this->xml->addChild('ResAddress2', $this->PostValues['ResAddress2']);
	    $this->xml->addChild('ResSuburb', $this->PostValues['ResSuburb']);
	    $this->xml->addChild('ResState', $this->PostValues['ResState']);
	    $this->xml->addChild('ResPostCode', $this->PostValues['ResPostCode']);
	    $this->xml->addChild('DelAddress1', $this->PostValues['DelAddress1']);
	    $this->xml->addChild('DelAddress2', $this->PostValues['DelAddress2']);
	    $this->xml->addChild('DelSuburb', $this->PostValues['DelSuburb']);
	    $this->xml->addChild('DelState', $this->PostValues['DelState']);
	    $this->xml->addChild('DelPostCode', $this->PostValues['DelPostCode']);
	    if($this->BasketData)

	    {

	    	$this->BasketDataXmlBulder( $this->BasketData, $this->xml );

	    }

		$types = $this->xml->addChild('TenderTypes')->addChild('TenderType');

		$types->addChild('Tender','Openpay');

		$types->addChild('Amount',$this->PurchasePrice);

		return $this->xml;

	}



	//make the busket data request

	public function BasketDataXmlBulder( $data, &$xml_data ) {

		$mainNode = $xml_data->addChild('BasketData');

		foreach( $data->BasketData['BasketItem'] as $key => $value ) {

			$subnode = $mainNode->addChild('BasketItem');

			$subnode->addChild('ItemName',htmlspecialchars($value['ItemName']));

			$subnode->addChild('ItemGroup',htmlspecialchars($value['ItemGroup']));

			$subnode->addChild('ItemCode',htmlspecialchars($value['ItemCode']));

			$subnode->addChild('ItemGroupCode',htmlspecialchars($value['ItemGroupCode']));

			$subnode->addChild('ItemRetailUnitPrice',htmlspecialchars($value['ItemRetailUnitPrice']));

			$subnode->addChild('ItemQty',htmlspecialchars($value['ItemQty']));

			$subnode->addChild('ItemRetailCharge',htmlspecialchars($value['ItemRetailCharge']));

		}

	}

	/*

	 * returns : Order Detailes

	 */

	public function _checkorder()

	{

	    try {

		  	\openpayau\openpaylaravel\lib\Openpay\Validation\Validation::_minmaxPrice($this->PurchasePrice);

		  	//If the exception is thrown, this text will not be shown

		  	$this->_updateUrl();

		    $this->_prepareXmldocument();

		    $this->_sendRequest();

		    $this->_parseResponse();

		    return $this->response;

		}

		catch(Exception $e) {

		  	echo 'Message: ' .$e->getMessage();

		}

	}

}

	