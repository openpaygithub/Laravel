<?php
namespace openpayau\openpaylaravel\lib\Openpay\Api;
/**
 * Class OpenpayCharge
 *
 * Call 2 - Online Plan Creation Post
 *
 * @package OpenPay\Api
 
 */
class OpenpayCharge
{
	//this method is making the dynamic url and redirect to openpay login page
	public static function _charge($pagegurl)
	{
		//echo $pagegurl;die;
		return redirect($pagegurl)->send();
		exit;
	
	}
	
	/*After the payment  process complited on openpay, it will redirect to the merchant website with help of callback url and user will get following response.
				Success Result [JamCallbackURL]?status=SUCCESS&planid=1000000004231&orderid=h00000001
				
				Cancel Result [JamCancelURL or JamCallbackURL]?status=CANCELLED&planid=1000000004231&orderid=h00000001
				
				Failure Result [JamFailURL or JamCallbackURL]?status=FAILURE&planid=1000000004231&orderid=h00000001
	*/
}
?>
