<?php
session_start();
require_once('../PPBootStrap.php');
include('../../wp-config.php');

 
/*
 * shipping adress
 */
$address = new AddressType();
$address->Name = "asd";
$address->Street1 = $_POST['address1'];
$address->Street2 = $_POST['address2'];
$address->CityName = $_POST['city'];
$address->StateOrProvince = $_POST['state'];
$address->PostalCode = $_POST['zip'];
$address->Country = $_POST['country'];
$address->Phone = $_POST['phone'];


$orderTotal = new BasicAmountType();
$orderTotal->currencyID = $p_currency;
$orderTotal->value = $p_price;

$paymentDetails = new PaymentDetailsType();
$paymentDetails->ShipToAddress = $address;

$itemDetails = new PaymentDetailsItemType();
$itemDetails->Name = $p_name;

$itemDetails->Amount = $orderTotal;
/*
 * Item quantity. This field is required when you pass a value for ItemCategory.
 */
$itemDetails->Quantity = '1';
/*
 * Indicates whether an item is digital or physical. 
 */
$itemDetails->ItemCategory = 'Physical';

$paymentDetails->PaymentDetailsItem[0] = $itemDetails;
$paymentDetails->OrderTotal = $orderTotal;
if (isset($_REQUEST['notifyURL'])) {
    $paymentDetails->NotifyURL = $_REQUEST['notifyURL'];
}

$personName = new PersonNameType();
$personName->FirstName = $firstName;
$personName->LastName = $lastName;

//information about the payer
$payer = new PayerInfoType();
$payer->PayerName = $personName;
$payer->Address = $address;
$payer->PayerCountry = $_POST['country'];

$cardDetails = new CreditCardDetailsType();
$cardDetails->CreditCardNumber = $_POST['creditCardNumber'];
/*
 *
  Type of credit card. For UK, only Maestro, MasterCard, Discover, and
  Visa are allowable. For Canada, only MasterCard and Visa are
  allowable and Interac debit cards are not supported. It is one of the
  following values:

 * Visa
 * MasterCard
 * Discover
 * Amex
 * Solo
 * Switch
 * Maestro: See note.
  `Note:
  If the credit card type is Maestro, you must set currencyId to GBP.
  In addition, you must specify either StartMonth and StartYear or
  IssueNumber.`
 */
$cardDetails->CreditCardType = $_POST['creditCardType'];
$cardDetails->ExpMonth = $_POST['expDateMonth'];
$cardDetails->ExpYear = $_POST['expDateYear'];
$cardDetails->CVV2 = $_POST['cvv2Number'];
$cardDetails->CardOwner = $payer;

$ddReqDetails = new DoDirectPaymentRequestDetailsType();
$ddReqDetails->CreditCard = $cardDetails;
$ddReqDetails->PaymentDetails = $paymentDetails;
$ddReqDetails->PaymentAction = $_REQUEST['paymentType'];

$doDirectPaymentReq = new DoDirectPaymentReq();
$doDirectPaymentReq->DoDirectPaymentRequest = new DoDirectPaymentRequestType($ddReqDetails);

/*
 * 		 ## Creating service wrapper object
  Creating service wrapper object to make API call and loading
  Configuration::getAcctAndConfig() returns array that contains credential and config parameters
 */
$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
try {
    /* wrap API method calls on the service object with a try catch */
    $doDirectPaymentResponse = $paypalService->DoDirectPayment($doDirectPaymentReq);
} catch (Exception $ex) {
    include_once("../Error.php");
    exit;
}
if (isset($doDirectPaymentResponse)) 
{
	echo "<pre>";	
		print_r($doDirectPaymentResponse);
	echo "</pre>";	
}
?>
