<?php
	include('client/BlibliMerchantBasicAuthClient.php');

	function __autoload($classname) {
		echo "string";
		echo "string";
		echo "string";
		echo "string";
	    $filename = $classname . ".php";

	    if(file_exists( $filename ))
	    {
	        include_once($filename);
	    }
	}
	//import this class to use Blibli Merchant API client
	$client = new BlibliMerchantBasicAuthClient();

	###----------------------------------------------------###
	###---------- BASE API CONFIGURATION SAMPLE -----------###
	###----------------------------------------------------###
	//Base API configuration, for any GET & POST request
	//set this as global function of your framework, you need to pass this object for every request
	$config = new ApiConfig(); 
	$config->setApiClientId("mta-api-clientsdk-cc80f"); // your api client id
	$config->setApiClientKey("mta-api-ySvFBOwPHTTBhccx89y2QxORSyFEesT55H2ws95fbPs8fsNV9y"); // your api client key
	$config->setApiSellerKey("495930D13E51161331FB6423B048FB759B39E1573F90673F94558D727C04E917"); // your api seller key
    $config->setMtaUsername("client.sdk@mailinator.com"); //your MTA username
//	$config->setSecretKey("secret"); //your API secret key
	$config->setBusinessPartnerCode("SDC-60001"); //your Business Partner Code / Merchant Code
	$config->setPlatformName("My Company"); //your company name/platform name
	$config->setTimeoutSecond(4); //your request timeout

	###----------------------------------------------------###
	###-------------- API TYPE [GET] SAMPLE ---------------###
	###----------------------------------------------------###
	$url = "https://api-uata.gdn-app.com/v2/proxy/mta/api/businesspartner/v1/order/orderList";

	//set your request parameter url
    //no need to send: channelId, username, storeId, requestId, businessPartnerCode and merchantCode
    //they generated automatically by client codes
	$params = array( 
		"yourcustomparameter" => "value",
		"yourcustomparameter2" => "value"
	);

	//invoke [Get] Order List API
	$response = $client->invokeGet($url, $params, $config);
	echo $response;
	echo "<hr>";

	###----------------------------------------------------###
	###-------------- API TYPE [POST] SAMPLE ---------------###
	###----------------------------------------------------###
	$url = "https://api-uata.gdn-app.com/v2/proxy/mta/api/businesspartner/v1/order/fulfillRegular";

	//Body request sample for Fulfill Regular Order API
	//NOTE! Please see codes under '/sample_request_body' as sample of body object request
	$body = array(
		"type" => 1,
		"orderNo" => "25100026490",
		"orderItemNo" => "25000179189",
		"combineShipping" => array(
			array(
				"orderNo" => "25100026490",
				"orderItemNo" => "25000179189"
			)
		),
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