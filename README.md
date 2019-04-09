<h1>Openpay Sdk laravel 5.4 Documentation</h1>



 


&nbsp;&nbsp;This docmetation basically for composer php. if you want to use our sdk for composer based php like laravel go to install Openpay composer package run the below command:

<pre style="background-color: #d3f1f3; color: black;">      composer require openpayau/openpaylaravel dev-master</pre>
  
<h3>&nbsp;&nbsp;There is an instruction for the use. Here openpayau is vander name Laravel Framework:</h3>

- **To install Openpay composer package run the below command**
  **composer require openpayau/openpaylaravel dev-master**

<pre style="background-color: #d3f1f3; color: black;">     *After Installation give write permission to the log folder in the path: 
     "/vendor/openpayau/openpay/lib/Openpay/log".
</pre>

- **Include the Openpay.php in the any controller page**
   
<pre style="background-color: #d3f1f3; color: black;">      require(app_path('/../vendor/openpayau/openpaylaravel/lib/Openpay/Common/Openpay.php'));</pre>
   
-  **In the file the basic urls are define like this and use those constant**

<pre style="background-color: #d3f1f3; color: black;">      define("URL","https://retailer.myopenpay.com.au/ServiceTraining/JAMServiceImpl.svc/");  //Openpay</pre> 
  
  <br> 
   Test Mode Or Live Mode URL place here:
   
<pre style="background-color: #d3f1f3; color: black;">        define("CALLBACK_URL",url('/callback'));                                      //Openpay Callback URL place here
        define("CANCEL_URL",url('/cancel'));                                          //Openpay Cancel URL place here
        define("FAILURE_URL",url('/failure'));                                        //Openpay Failure URL place here
        define("FORM_URL","https://retailer.myopenpay.com.au/WebSalesTraining/");     //Openpay Form Submit URL place here
        define("JAMTOKEN","Put your jamtoken here");  //Openpay Test Mode or Live Mode JAMTOKEN place here.(* When it is generate just change the JAMTOKEN) 
</pre>


- **Then you have to set the basic parameters like this** 
-----------------------------------------------------------------------------
 <br>                          
<h3>                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Parameters from site</h3>





<pre style="background-color: #d3f1f3; color: black;">   

        if (!Session::has('cart')) 
        {
            return redirect()->route('product.shoppingcart');
        }
        
        $oldCart = Session::get('cart');
        
        $cart = new Cart($oldCart);
       
        try 
        {
              $chars = "0123456789";
              $res = "";
                 for ($i = 0; $i < 4; $i++) 
                 {
                   $res .= $chars[mt_rand(0, strlen($chars)-1)];
                 }

      $url=URL;

      $jamtoken=JAMTOKEN; 

      $PurchasePrice = 170.00;             //Format : 100.00(Not more than $1 million) , This values are comming form checkout form
      
      $JamCallbackURL = CALLBACK_URL;     //Not more than 250 characters
      
      $JamCancelURL = CANCEL_URL;         //Not more than 250 characters
      
      $JamFailURL =FAILURE_URL;          //Not more than 250 characters
	        
      $form_url =   FORM_URL;
      
      $JamRetailerOrderNo = '10000478';         //Consumer site order number, This values are comming form checkout form
      
      $JamEmail = 'gautamtest@gmail.com';       //Not more than 150 characters, This values are comming form checkout form
      
      $JamFirstName = 'Test';                   //First name(Not more than 50 characters), This values are comming form checkout form
      
      $JamOtherNames = 'Devloper';              //Middle name(Not more than 50 characters), This values are comming form checkout form
      
      $JamFamilyName = 'Test';                  //Last name(Not more than 50 characters), This values are comming form checkout form
      
      $JamDateOfBirth = '04 Nov 1982';          //dd mmm yyyy, This values are comming form checkout form
      
      $JamAddress1 = '15/520 Collins Street';   //Not more than 100 characters, This values are comming form checkout form
      
      $JamAddress2 = '';                        //Not more than 100 characters, This values are comming form checkout form
      
      $JamSubrub = 'Melbourne';                 //Not more than 100 characters, This values are comming form checkout form
      
      $JamState = 'VIC';                        //Not more than 3 characters, This values are comming form checkout form
      
      $JamPostCode = '3000';                    //Not more than 4 characters, This values are comming form checkout form
      
      $JamDeliveryDate = '01 Jan 2019';         //dd mmm yyyy, This values are comming form checkout form

      $JamGender = 'M';                         //M/F, This values are comming form checkout form

      $JamPhoneNumber = '9830000000';          //, This values are comming form checkout form

      $ChargeBackCount = 0;                     //How many chargebacks are known to have been received from this customer?-1 = Unknown

      $CustomerQuality = 1;
</pre>
<br>
<pre>
$PostValues = array(
                  'RetailerOrderNo'=>$JamRetailerOrderNo,
                  'ChargeBackCount'=>$ChargeBackCount,
                  'CustomerQuality'=>$CustomerQuality,
                  'FirstName'=>$JamFirstName,
                  'OtherNames'=>$JamOtherNames,
                  'FamilyName'=>$JamFamilyName,
                  'Email'=>$JamEmail,
                  'DateOfBirth'=>$JamDateOfBirth,
                  'Gender'=>$JamGender,
                  'PhoneNumber'=>$JamPhoneNumber,
                  'ResAddress1'=>$JamAddress1,
                  'ResAddress2'=>$JamAddress2,
                  'ResSuburb'=>$JamSubrub,
                  'ResState'=>$JamState,
                  'ResPostCode'=>$JamPostCode,
                  'DelAddress1'=>$JamAddress1,
                  'DelAddress2'=>$JamAddress2,
                  'DelSuburb'=>$JamSubrub,
                  'DelState'=>$JamState,
                  'DelPostCode'=>$JamPostCode
                  );  
</pre>
<br>

- **Now you have to call the Call-1 NEW ONLINE ORDER API menthods like this**

<pre style="background-color: #d3f1f3; color: black;">        
  $Method = "NewOnlineOrder";
        $obj = new \openpayau\openpaylaravel\lib\Openpay\Api\NewOnlineOrder(URL,$Method,$PurchasePrice,JAMTOKEN, AUTHTOKEN,'','','','','','',$PostValues);
        $responsecall1 = $obj->_checkorder();
        $output = json_decode($responsecall1,true);
        $openErrorStatus = new \openpayau\openpaylaravel\lib\OpenPay\Exception\ErrorHandler();
        if($openErrorStatus !='')
        {
            $openErrorStatus->_checkstatus($output['status']);  
        } 
</pre>
<br>

- **Store Call-1 response in log file use this code**

 <pre style="background-color: #d3f1f3; color: black;">       $log  = "Call-time: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
       "Log: ".$responsecall1.PHP_EOL.
       "-------------------------".PHP_EOL;
            
</pre>

 Save string to log, use FILE_APPEND to append:

<pre style="background-color: #d3f1f3; color: black;">      file_put_contents(app_path('/../vendor/openpayau/openpaylaravel/lib/Openpay').'/Log/log'.date("j.n.Y").'.log', $log, FILE_APPEND);</pre>

<br>

- **Now we got plan id and ready for payment so here it is by Call-2 API**


<pre style="background-color: #d3f1f3; color: black;">     
  
    if($output)
            {
              if($output['status'] == 0){

                $userdetails = Auth::user();
                $order = new Order;
                    $order->user_id = $userdetails->id;
                    $order->payment_id = 0;
                    $order->address = $request->input('address');
                    $order->name = $request->input('name');
                    $order->email = $request->input('email');
                    $order->final_amount = $PurchasePrice;
                    $order->plan_id = $output['PlanID'];

                    $order->save();
                    
                  $JamPlanID = $output['PlanID'];             //Plan ID retrieved from Web Call 1 API
                  $pagegurl = $form_url.'?JamCallbackURL='.$JamCallbackURL.'&JamCancelURL='.$JamCancelURL.'&JamFailURL='.$JamFailURL.'&JamAuthToken='.urlencode(JAMTOKEN).'&JamPlanID='.urlencode( (string) $JamPlanID);
                  
                  
                  try {
                    if($JamDateOfBirth)
                      \openpayau\openpaylaravel\lib\OpenPay\Validation\Validation::_validateDate($JamDateOfBirth);   
                    if($JamDateOfBirth)
                      \openpayau\openpaylaravel\lib\OpenPay\Validation\Validation::_validateDate($JamDeliveryDate);
                    if($JamState)
                      \openpayau\openpaylaravel\lib\OpenPay\Validation\Validation::_validateState($JamState);
                    if($JamPostCode)
                      \openpayau\openpaylaravel\lib\OpenPay\Validation\Validation::_validatePostcode($JamPostCode);     
                    $charge = \openpayau\openpaylaravel\lib\OpenPay\Api\OpenpayCharge::_charge($pagegurl);
                  }
                  catch(Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                  }
                }else{
                  return redirect()->route('checkout')->with('error',$output['reason']);

                }
            }

        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
</pre>
<br>

-  **After the payment  process complited on openpay, it will redirect to the merchant website with help of callback url**

<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Success Url :</h5>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[JamCallbackURL]?status=SUCCESS&planid=3000000022284&orderid=1402

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Success Result :**
   
<pre style="background-color: #d3f1f3; color: black;">          Array(
                  [status] => 0 
                    [reason] => Array
                              (
                              ) 
                      [PlanID] => 3000000022284
                      [PurchasePrice] => 110.0000
              )</pre>

<br>
<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cancel Url :</h5> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[JamCancelURL or JamCallbackURL]?status=CANCELLED&planid=3000000022284&orderid=1402

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Cancel Result :**

<pre style="background-color: #d3f1f3; color: black;">          Array (
                  [status] => CANCELLED 
                  [planid] => 3000000022284 
                  [orderid] => 1402 
               ) </pre>

<br>
<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failure Url :</h5> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[JamFailURL or JamCallbackURL]?status=FAILURE&planid=3000000022284&orderid=1402

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Failure Result :**

<pre style="background-color: #d3f1f3; color: black;">          Array ( 
                  [status] => FAILURE 
                  [planid] => 3000000022284 
                  [orderid] => 1402 
               )</pre>

<br>

- **Add the Call-3 PAYMENT CAPTURE API like below**
 
<pre style="background-color: #d3f1f3; color: black;">       
		$PlanID = '3000000019868'; // callback url get  
        $Method = "OnlineOrderCapturePayment";
        $obj=new\openpayau\openpaylaravel\lib\OpenPay\Api\OnlineOrderCapturePayment(URL,$Method,'',JAMTOKEN,AUTHTOKEN,$PlanID);
        $response = $obj->_checkorder(); 
        $output = json_decode($response,true); 
        $openErrorStatus=new\openpayau\openpaylaravel\lib\OpenPay\Exception\ErrorHandler();
        if($openErrorStatus !='')
            {
                $openErrorStatus->_checkstatus($output['status']);  
            }</pre>



Something to write to txt log:

<pre style="background-color: #d3f1f3; color: black;">      $log  = "Call 3 log time: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
      "Log: ".$response.PHP_EOL.
      "-------------------------".PHP_EOL;
</pre>        
<br>

Save string to log, use FILE_APPEND to append:

<pre style="background-color: #d3f1f3; color: black;">      file_put_contents(app_path('/../vendor/openpayau/openpaylaravel/lib/Openpay').'/Log/log'.date("j.n.Y").'.log', $log, FILE_APPEND);</pre>

<br>

- **Check your order status**
       

<pre style="background-color: #d3f1f3; color: black;">      $PlanID = '3000000019868';                                      //Plan ID retrieved from Web Call 1 API
      $Method = "OnlineOrderStatus";
      $obj = new \openpayau\openpaylaravel\lib\OpenPay\Api\OnlineOrderStatus(URL,$Method,'',JAMTOKEN,AUTHTOKEN,$PlanID);
      $response = $obj->_checkorder(); 
      $output = json_decode($response,true); 
      $openErrorStatus=new\openpayau\openpaylaravel\lib\OpenPay\Exception\ErrorHandler();</pre>
        


Something to write to txt log:

<pre style="background-color: #d3f1f3; color: black;">       $log  = "Order status log time: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
       "Log: ".$response.PHP_EOL.
       "-------------------------".PHP_EOL;</pre>


Save string to log, use FILE_APPEND to append:

<pre style="background-color: #d3f1f3; color: black;">      file_put_contents(app_path('/../vendor/openpayau/openpaylaravel/lib/Openpay').'/Log/log'.date("j.n.Y").'.log', $log, FILE_APPEND);</pre>
<br>

- **For Refund Process**


<pre style="background-color: #d3f1f3; color: black;">        $PlanID = '3000000020110';          //Plan ID retrieved from Web Call 1 API
        $Method = "OnlineOrderReduction";
        $ReducePriceBy = 50.00;             //The amount you want to refund
        $type = False;                      //make True if want to refund full Plan price</pre>
        
<pre style="background-color: #e7f3d3; color: black;">        //echo $ReducePriceBy.'=='.$type;
        //die;
        //True if want to refund full Plan price</pre>

<pre style="background-color: #d3f1f3; color: black;">        $obj = new \openpayau\openpaylaravel\lib\Openpay\Api\PlanPurchasePriceReductionCall(URL, $Method, '', JAMTOKEN, AUTHTOKEN, $PlanID, '', $ReducePriceBy, $type);
        $response = $obj->_checkorder(); 
        $output = json_decode($response,true);    [dd($output);]
        $openErrorStatus=new\openpayau\openpaylaravel\lib\Openpay\Exception\ErrorHandler();</pre>
        


Something to write to txt log:
<pre style="background-color: #d3f1f3; color: black;">         $log  = "Order refund log time: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
         "Log: ".$response.PHP_EOL.
         "-------------------------".PHP_EOL;</pre>


Save string to log, use FILE_APPEND to append:
<pre style="background-color: #d3f1f3; color: black;">        file_put_contents(app_path('/../vendor/openpayau/openpaylaravel/lib/Openpay').'/Log/log'.date("j.n.Y").'.log', $log, FILE_APPEND);</pre>
        .

<br>

<h4>Refund process will be excute as per the following steps:</h4>

<pre style="background-color: #e3d1e9; color: black;">    1. At the time of full refund the $ReducePriceBy should be set null and $type should be set False.

    2.For Partial refund $ReducePriceBy should be set as needed and $type should be set True.

    3.Retailers will get refund upto a certain amount which will be set by the Openpay merchant.Once the retailer has reached maximum refund amount limit they will get a message like “Invalid Web Sales Plan Status For Partial Refund”.</pre>

<br>

- **For Plan Dispatch**

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This call supports Retailers that are set up to not receive any payment for their Plans until their system has issued a &nbsp;&nbsp;&nbsp;&nbsp;dispatch notice. This allows those retailers to make adjustments to their orders as needed prior to fulfilment and then receive &nbsp;&nbsp;&nbsp;&nbsp;the payment and reconciliation information after the dispatch event occurs.


<pre style="background-color: #d3f1f3; color: black;">    $PlanID = '3000000020110';                                    //Plan ID retrieved from Web Call 1 API
    $Method = "OnlineOrderDispatchPlan";
    $obj=new\openpayau\openpaylaravel\lib\Openpay\Api\OnlineOrderDispatchPlan(URL,$Method,'',JAMTOKEN,AUTHTOKEN,$PlanID);
    $response = $obj->_checkOrderDispatchPlan(); 
    $output = json_decode($response,true); 
    $openErrorStatus=new\openpayau\openpaylaravel\lib\Openpay\Exception\ErrorHandler();</pre>
              


Something to write to txt log:
<pre style="background-color: #d3f1f3; color: black;">    $log  = "Order dispatch log time: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
    "Log: ".$response.PHP_EOL.
    "-------------------------".PHP_EOL;</pre>

Save string to log, use FILE_APPEND to append:
<pre style="background-color: #d3f1f3; color: black;">    file_put_contents(app_path('/../vendor/openpayau/openpaylaravel/lib/Openpay').'/Log/log'.date("j.n.Y").'.log', $log, FILE_APPEND);</pre>




- **For Online Order Fraud Alert Process**


<pre style="background-color: #d3f1f3; color: black;">        $PlanID = '3000000020110';          //Plan ID retrieved from Web Call 1 API
        $Method = "OnlineOrderFraudAlert";
        $Details = $req->input('fdetails'); //fraud text
        


<pre style="background-color: #d3f1f3; color: black;">       $obj = new \openpayau\openpaylaravel\lib\Openpay\Api\OnlineOrderFraudAlert(URL, $Method, '', JAMTOKEN, AUTHTOKEN, $PlanID, '', '' , '',$Details);
       $response = $obj->_OnlineOrderFraudAlert(); 
        $output = json_decode($response,true);    [dd($output);]
        $openErrorStatus=new\openpayau\openpaylaravel\lib\Openpay\Exception\ErrorHandler();</pre>
        


Something to write to txt log:
<pre style="background-color: #d3f1f3; color: black;">         $log  = "Order fraud log time: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
         "Log: ".$response.PHP_EOL.
         "-------------------------".PHP_EOL;</pre>


Save string to log, use FILE_APPEND to append:
<pre style="background-color: #d3f1f3; color: black;">        file_put_contents(app_path('/../vendor/openpayau/openpaylaravel/lib/Openpay').'/Log/log'.date("j.n.Y").'.log', $log, FILE_APPEND);</pre>
        .

<br>
This API call is provided for those systems that support latent customer fraud warning alerts that may be received outside of the normal process.
