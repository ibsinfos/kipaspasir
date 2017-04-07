<?php
/**************************************************************************************************
| Fiverr Script
| http://www.fiverrscript.com
| webmaster@fiverrscript.com
|
|**************************************************************************************************
|
| By using this software you agree that you have read and acknowledged our End-User License 
| Agreement available at http://www.fiverrscript.com/eula.html and to be bound by it.
|
| Copyright (c) FiverrScript.com. All rights reserved.
|**************************************************************************************************/
include("include/config.php");
include("include/functions/import.php");
define("IPN_SECURITY_CODE", $config['ap_code']);
define("MY_MERCHANT_EMAIL", $config['alertpay_email']);

$receivedSecurityCode = urldecode($_POST['ap_securitycode']);
$receivedMerchantEmailAddress = urldecode($_POST['ap_merchant']);	
$transactionStatus = urldecode($_POST['ap_status']);
$testModeStatus = urldecode($_POST['ap_test']);	
$purchaseType = urldecode($_POST['ap_purchasetype']);
$totalAmountReceived = urldecode($_POST['ap_totalamount']);
$feeAmount = urldecode($_POST['ap_feeamount']);
$netAmount = urldecode($_POST['ap_netamount']);
$transactionReferenceNumber = urldecode($_POST['ap_referencenumber']);
$currency = urldecode($_POST['ap_currency']); 	
$transactionDate= urldecode($_POST['ap_transactiondate']);
$transactionType= urldecode($_POST['ap_transactiontype']);
$customerFirstName = urldecode($_POST['ap_custfirstname']);
$customerLastName = urldecode($_POST['ap_custlastname']);
$customerAddress = urldecode($_POST['ap_custaddress']);
$customerCity = urldecode($_POST['ap_custcity']);
$customerState = urldecode($_POST['ap_custstate']);
$customerCountry = urldecode($_POST['ap_custcountry']);
$customerZipCode = urldecode($_POST['ap_custzip']);
$customerEmailAddress = urldecode($_POST['ap_custemailaddress']);
$myItemName = urldecode($_POST['ap_itemname']);
$myItemCode = urldecode($_POST['ap_itemcode']);
$myItemDescription = urldecode($_POST['ap_description']);
$myItemQuantity = urldecode($_POST['ap_quantity']);
$myItemAmount = urldecode($_POST['ap_amount']);
$item_number = urldecode($_POST['apc_1']);
$featured = urldecode($_POST['apc_2']);

if($featured == "featured")
{
	if ($receivedMerchantEmailAddress != MY_MERCHANT_EMAIL) 
	{
		echo "Error 1";
	}
	else 
	{	
		if ($receivedSecurityCode != IPN_SECURITY_CODE) 
		{
			echo "Error 2";
		}
		else {
			if ($transactionStatus == "Success") 
			{
				if ($testModeStatus == "1") 
				{
					$transactionReferenceNumber = "Test Payment";
				}
				$user_id = $myItemCode;
				$PID = $item_number;
				$apcurrency = $config['alertpay_currency'];
				$price = $config['fprice'];
				
				if($apcurrency==$currency && $totalAmountReceived==$price)
				{
					$qry = "INSERT INTO paypal_table2 VALUES (0 , '$customerEmailAddress', '$transactionDate', '$transactionReferenceNumber', '$customerFirstName', '$customerLastName', '$customerEmailAddress', 'alertpay', '$purchaseType', 'alertpay', '$myItemName', '$item_number', $myItemQuantity, $totalAmountReceived, '$currency', '$customerAddress', '".nl2br($customerAddress)."', '$customerCity', '$customerState', '$customerZipCode', '$customerCountry', 'alertpay', '$customerEmailAddress', '$purchaseType', 'alertpay', 'alertpay', '$purchaseType')";
					if (mysql_query($qry)) 
					{
						$transid = mysql_insert_id(); 
						if($PID > 0)
						{
							$query = "INSERT INTO featured SET PID='".mysql_real_escape_string($PID)."', time='".time()."', price='".mysql_real_escape_string($price)."', PAYPAL='".mysql_real_escape_string($transid)."'"; 
							$executequery=$conn->execute($query);
							
							$query = "UPDATE posts SET feat='1' WHERE PID='".mysql_real_escape_string($PID)."'"; 
							$executequery=$conn->execute($query);
						}
					}
					else 
					{
						echo "Error 3";
					}
				}
				else 
				{
					echo "Error 4";
				}
			}
			else 
			{
				echo "Error 5";
			}
		}
	}
}
else
{
	if ($receivedMerchantEmailAddress != MY_MERCHANT_EMAIL) 
	{
		echo "Error 1";
	}
	else 
	{	
		if ($receivedSecurityCode != IPN_SECURITY_CODE) 
		{
			echo "Error 2";
		}
		else {
			if ($transactionStatus == "Success") 
			{
				if ($testModeStatus == "1") 
				{
					$transactionReferenceNumber = "Test Payment";
				}
				$user_id = $myItemCode;
				
				$query = "select PID, totalprice, multi from order_items where IID='".mysql_real_escape_string($item_number)."'"; 
				$executequery=$conn->execute($query);
				$PID = $executequery->fields['PID'];
				$price = $executequery->fields['totalprice'];
				$multi = $executequery->fields['multi'];
				$apcurrency = $config['alertpay_currency'];
				
				if($apcurrency==$currency && $totalAmountReceived==$price)
				{
					$qry = "INSERT INTO paypal_table VALUES (0 , '$customerEmailAddress', '$transactionDate', '$transactionReferenceNumber', '$customerFirstName', '$customerLastName', '$customerEmailAddress', 'alertpay', '$purchaseType', 'alertpay', '$myItemName', '$item_number', $myItemQuantity, $totalAmountReceived, '$currency', '$customerAddress', '".nl2br($customerAddress)."', '$customerCity', '$customerState', '$customerZipCode', '$customerCountry', 'alertpay', '$customerEmailAddress', '$purchaseType', 'alertpay', 'alertpay', '$purchaseType')";
					if (mysql_query($qry)) 
					{
						$transid = mysql_insert_id(); 
						if($user_id > 0)
						{
							if($multi > 1)
							{
								$query = "select price from posts where PID='".mysql_real_escape_string($PID)."'"; 
								$executequery=$conn->execute($query);
								$eachprice = $executequery->fields['price'];
								for ($i=1; $i<=$multi; $i++)
								{
									$query = "INSERT INTO orders SET USERID='".mysql_real_escape_string($user_id)."', PID='".mysql_real_escape_string($PID)."', IID='".mysql_real_escape_string($item_number)."', time_added='".time()."', status='0', price='".mysql_real_escape_string($eachprice)."'"; 
									$executequery=$conn->execute($query);
									$order_id = mysql_insert_id();
									if($order_id > 0)
									{
										$query = "INSERT INTO payments SET USERID='".mysql_real_escape_string($user_id)."', OID='".mysql_real_escape_string($order_id)."', time='".time()."', price='".mysql_real_escape_string($eachprice)."', t='1', PAYPAL='".mysql_real_escape_string($transid)."'"; 
										$executequery=$conn->execute($query);
										
										$query = "UPDATE posts SET rev=rev+$eachprice WHERE PID='".mysql_real_escape_string($PID)."'"; 
										$executequery=$conn->execute($query);
									}
								}
							}
							else
							{
								$query = "INSERT INTO orders SET USERID='".mysql_real_escape_string($user_id)."', PID='".mysql_real_escape_string($PID)."', IID='".mysql_real_escape_string($item_number)."', time_added='".time()."', status='0', price='".mysql_real_escape_string($price)."'"; 
								$executequery=$conn->execute($query);
								$order_id = mysql_insert_id();
								if($order_id > 0)
								{
									$query = "INSERT INTO payments SET USERID='".mysql_real_escape_string($user_id)."', OID='".mysql_real_escape_string($order_id)."', time='".time()."', price='".mysql_real_escape_string($price)."', t='1', PAYPAL='".mysql_real_escape_string($transid)."'"; 
									$executequery=$conn->execute($query);
									
									$query = "UPDATE posts SET rev=rev+$price WHERE PID='".mysql_real_escape_string($PID)."'"; 
									$executequery=$conn->execute($query);
								}
							}
						}
					}
					else 
					{
						echo "Error 3";
					}
				}
				else 
				{
					echo "Error 4";
				}
			}
			else 
			{
				echo "Error 5";
			}
		}
	}
}
?>