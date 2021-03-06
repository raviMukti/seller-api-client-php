<?php
	include('client/BlibliSellerBasicAuthClient.php');

	function __autoload($classname) {
	    $filename = $classname . ".php";

	    if(file_exists( $filename ))
	    {
	        include_once($filename);
	    }
	}
	//import this class to use Blibli Merchant API client
	$client = new BlibliSellerBasicAuthClient();

	###----------------------------------------------------###
	###---------- BASE API CONFIGURATION SAMPLE -----------###
	###----------------------------------------------------###
	//Base API configuration, for any GET & POST request
	//set this as global function of your framework, you need to pass this object for every request
	$config = new ApiConfig(); 
	$config->setApiClientid("mta-api-clientsdk-cc80f"); // your api client id
	$config->setApiClientkey("mta-api-ySvFBOwPHTTBhccx89y2QxORSyFEesT55H2ws95fbPs8fsNV9y"); // your api client key
	$config->setApiSellerkey("495930D13E51161331FB6423B048FB759B39E1573F90673F94558D727C04E917"); // your api seller key
	$config->setSignatureKey("secret"); //your API secret key, it's optional depends on the selected seller choice
	$config->setBusinessPartnerCode("SDC-60001"); //your Business Partner Code / Merchant Code
	$config->setPlatformName("My Company"); //your company name/platform name
	$config->setTimeoutSecond(4); //your request timeout

	###----------------------------------------------------###
	###-------------- API TYPE [GET] SAMPLE ---------------###
	###----------------------------------------------------###
	$url = "https://api-uata.gdn-app.com/v2/proxy/mta/api/businesspartner/v1/order/orderDetail";

	//set your request parameter url
    //no need to send: channelId, username, storeId, requestId, businessPartnerCode and merchantCode
    //they generated automatically by client codes
    $params = array();
    $params["orderNo"] = "40000198525"; //set to filter by orderNo
    $params["orderItemNo"] = "40000262429"; //set to filter by orderItemNo

	//invoke [Get] Order List API
	$response = $client->invokeGet($url, $params, $config);
	echo $response;
	echo "<hr>";

    $response = json_decode($response);

	###----------------------------------------------------###
	###-------------- API TYPE [POST] SAMPLE ---------------###
	###----------------------------------------------------###
    $url = "https://api-uata.gdn-app.com/v2/proxy/seller/v1/orders/regular/" .
        $response->value->packageId . "/fulfill";

	//Body request sample for Fulfill Regular Order API
	//NOTE! Please see codes under '/sample_request_body' as sample of body object request
	$body = array(
        "awbNo" => "123456"
	);

	//set your request parameter url
    //no need to send: channelId, username, storeId, requestId, businessPartnerCode and merchantCode
    //they generated automatically by client codes
    //set to empty Array if the API doesn't need parameter url
	$params = array();

	//invoke [POST] Fulfill Order Regular API 
	$response = $client->invokePost($url, $params, $body, $config);
	echo $response;

?>