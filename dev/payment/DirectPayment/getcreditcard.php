<?php
session_start();
include('../../wp-config.php');

$_SESSION['payment_id'];

foreach( $wpdb->get_results("SELECT * FROM im_payments where id='".$_SESSION['payment_id']."'") as $key => $row)
{
	$amount = $row->amount;
	$tour_id = $row->tour_id;
	$user_id = $row->user_id;
} 

 $p_price = $amount;
 $p_currency = 'USD';
 $p_name = get_the_title($tour_id); 
 
?>
<html>
        <head>
        <title>paypal payments via credit card</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/loadding.css">
        <link rel="stylesheet" type="text/css" href="css/popup-style.css">
        <meta name="robots" content="noindex, nofollow">
        
        </head>

        <body>

<div id="main">
          <center>
    <h1>PayPal Payments via Credit Card</h1>
  </center>
          <form action="DoDirectPayment.php" method="POST">
    <div id="container">
              <h2>Pay with my debit or credit card</h2>
              <hr/>
              <center>
        <h3>Billing Information</h3> 
      </center>
      
     
              <input type="hidden" name="paymentType" value="Sale"/>
              
              <table style="width:100%">
				
        <tr>
                  <td id="td-label">Card type : </td>
                  <td><select name="creditCardType">
                      <option value="Visa" selected="selected">Visa</option>
                      <option value="MasterCard">MasterCard</option>
                      <option value="Discover">Discover</option>
                      <option value="Amex">American Express</option>
                    </select></td>
                </tr>
        <tr>
                  <td id="td-label">Card number : </td>
                  <td><input type="text" name="creditCardNumber" id="cardno" placeholder="enter card number" value="4032035988760831" required="true"></td>
                </tr>
        <tr>
                  <td id="td-label">Expiry date : </td>
                  <td><div id="date-div">
                      <select name="expDateMonth">
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>
                    </div>
            <div id="year-div">
                      <select name="expDateYear">
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
              </select>
                    </div></td>
                </tr>
        <tr>
                  <td id="td-label">CVV : </td>
                  <td><div id="date-div">
                      <input type="text" name="cvv2Number" id="cvv" placeholder="cvv" value="962" required="true">
                    </div></td>
                </tr>
        <tr>
                  <td id="td-label">Amount( USD ) : </td>
                  <td><input type="text" name="amount" id="name" placeholder="enter amount" ></td>
                </tr>
      </table>
			
        <input  style="  width: 20%;"type="submit" id="buynow" name="DoDirectPaymentBtn" value="Pay Now">
      </center>
              <br>
            </div>
  </form>
          <img id="paypal_logo" style="float:right; margin: -30px -42px 0 0;" src="images/secure-paypal-logo.jpg"> </div>
<div id="pop2" class="simplePopup">
          <div id="loader">
    <div id="circularG">
              <div id="circularG_1" class="circularG"> </div>
              <div id="circularG_2" class="circularG"> </div>
              <div id="circularG_3" class="circularG"> </div>
              <div id="circularG_4" class="circularG"> </div>
              <div id="circularG_5" class="circularG"> </div>
              <div id="circularG_6" class="circularG"> </div>
              <div id="circularG_7" class="circularG"> </div>
              <div id="circularG_8" class="circularG"> </div>
            </div>
  </div>
        </div>
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.simplePopup.js" type="text/javascript"></script> 
<script type="text/javascript">

                                    $(document).ready(function() {

                                        $('input#buynow').click(function() {

                                            if ($('input#cardno').val() != '') {

                                                if ($('input#cvv').val() != '') {

                                                    $('#pop2').simplePopup();

                                                }

                                            }



                                        });

                                    });

        </script>
</body>
</html>