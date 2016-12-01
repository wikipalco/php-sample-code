<?php
$MerchantID 			= "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$Price 					= 100;
$Authority 				= $_POST['authority'];
$InvoiceNumber 			= $_POST['InvoiceNumber'];

if ($_POST['status'] == 1) {

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, 'http://gatepay.co/webservice/paymentVerify.php');
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type' => 'application/json'));
	curl_setopt($curl, CURLOPT_POSTFIELDS, "MerchantID=$MerchantID&Price=$Price&Authority=$Authority");
	curl_setopt($curl, CURLOPT_TIMEOUT, 400);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$result = json_decode(curl_exec($curl));
	curl_close($curl);

	if ($result->Status == 100) {
		echo "Transaction Invoice Number $InvoiceNumber Success. Transaction Tracking Code : ".$result->RefCode;
	} else {
		echo $result->Status;
	}

} else {
	echo 'Transaction Canceled By User';
}
?>