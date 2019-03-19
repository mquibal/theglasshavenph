<?php
session_start();
require_once "connect.php";
require '../vendor/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
//import the necessary classes of phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "paypal/start.php";

function generate_transaction_code() {
	$ref_num = "";
	$source = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];
	//we want to make a random 6 string long transaction code
	for ($i = 0; $i < 6; $i++){
		$index = rand(0,15); //generates a random number from 0 to 15
		//Append random character
		$ref_num = $ref_num . $source[$index];
	}
	//Q.how do we make sure that this doesn't repeat.
	//A.we add something else that never repeats. Time.
	$today = getdate(); //gets the datetime
	return $ref_num . "-" . $today[0]; //today[0] is the second since unix epoch
}

//get all details of the order
$user_id = $_SESSION['user']['id'];
$purchase_date = date("Y-m-d G:i:s"); //Q. what is the date format  here?
$status_id = 1;
$payment_mode_id = $_POST['payment_mode'];
$address = $_POST['addressLine1'];

// echo  $_POST['payment_mode'];
if ($payment_mode_id == 1){ //COD payment
	$trans_code = generate_transaction_code();
	$_SESSION['trans_code'] = $trans_code;

	//Create new order by create the sql statement to add a new entry in the orders table.
	$sql_query = "INSERT INTO orders (user_id, transaction_code, purchase_date, status_id, payment_mode_id) VALUES ('$user_id', '$trans_code', '$purchase_date', '$status_id', '$payment_mode_id');";

	$result = mysqli_query($conn, $sql_query);
	//we need to get the order_id of the new order created, why?
	//this to create the order details.
	//To get the previously created order_id
	$new_order_id = mysqli_insert_id($conn); //this looks for the most recently created id number and assigns it to $new_order_id

	//Populate the order_items
	if($result){
		//SESSION cart is just an indexed array for quantities and each index correspond to a specific item_id
		foreach($_SESSION['cart'] as $item_id => $qty){
			$item_query = "SELECT price FROM items WHERE id = '$item_id';";
			$item_result = mysqli_query($conn, $item_query);
			$item = mysqli_fetch_assoc($item_result);

			$sql = "INSERT INTO orders_items (order_id, item_id, quantity, price) VALUES ('$new_order_id', '$item_id', '$qty', '". $item['price']. "');";
			$ord_detail_result = mysqli_query($conn, $sql);
			// if($ord_detail_result){
			// 	echo "item success";
			// } else {
			// 	echo mysqli_error($conn);
			// }
		}
	} 

	//empties the cart.
	unset($_SESSION['cart']);

	//Send email to customer



	//Create a new instance of phpmailer.
	$mail = new PHPMailer(true);

	//Email contents:
	$staff_email = 'theglasshavenph@gmail.com'; //This is the email you created earlieremail
	$customer_email = $_SESSION['user']['email']; //Email of the user that is currently logged in.
	$email_subject = "The Glass Haven - Order Confirmation"; //This is up to you.
	$email_body = "<h3>Reference Number: $trans_code</h3> <p>Ship to $address</p>";

	//Actual Sending of email
	try { //Server settings
		// $mail->SMTPDebug = 4; //Enables us to see detailed debug output;
		//Removing debug will remove the messages and route us to confirmation.php
		$mail->isSMTP(); //Sets mailer to use SMTP to send email
		$mail->Host = 'smtp.gmail.com'; //uses Gmail's SMTP server
		$mail->SMTPAuth = true; //Enables SMTP authentication
		$mail->Username = $staff_email; //defines the email's username
		$mail->Password = "Glasshaven03"; //defines the email's password
		//Password is the password you created for the email.

		$mail->SMTPSecure = 'tls'; //Allows for TLS encryption, we can also use SSL
		$mail->Port = 587; //Port to connect to.

		//Recipients
		$mail->setFrom($staff_email, "The Glass Haven"); //Sets the sender's alias.
		$mail->addAddress($customer_email);
			

		//Content
		$mail->isHTML(true); //Sets email format to HTML
		$mail->Subject = $email_subject;
		$mail->Body = $email_body;
		$mail->SMTPOptions = array(
		    	'ssl' => array(
		        	'verify_peer' => false,
		        	'verify_peer_name' => false,
		    	    'allow_self_signed' => true
		    	)
			);

		$mail->send();

	} catch (Exception $e){
		echo "Message couldn't be sent. Mailer Error: ". $mail->ErrorInfo;
	}
	//try catch: it performs a block of code and if it fails it catches the error message

	//End send email

	mysqli_close($conn);

	header('location: ../views/confirmation.php');

} else { //paypal payment
$_SESSION['address'] = $_POST['addressLine1'];

$payer = new Payer();
$payer->setPaymentMethod('paypal'); 

$total = 0;
$items = [];
foreach ($_SESSION['cart'] as $id => $quantity) {
	$sql = "SELECT * FROM items WHERE id = $id";
	$result = mysqli_fetch_assoc(mysqli_query($conn,$sql));
	extract($result);
	$total += $price*$quantity;
	$item = new Item();
	$item->setName($name)
		->setCurrency('PHP')
		->setQuantity($quantity)
		->setPrice($price);

	$items[] = $item;
}

$item_list = new ItemList();
$item_list->setItems($items);

$amount = new Amount();
$amount->setCurrency('PHP')
	->setTotal($total);

$transaction = new Transaction();
$transaction
	->setAmount($amount)
	->setItemList($item_list)
	->setDescription('Payment for TheGlassHaven Purchase')
	->setInvoiceNumber(uniqid('TheGlassHaven_'));

$redirectUrls = new RedirectUrls();
$redirectUrls
	->setReturnUrl('http://localhost/cp2_glasshaven/app/controllers/pay.php?success=true')
	->setCancelUrl('http://localhost/cp2_glasshaven/app/controllers/pay.php?success=false');

$payment = new Payment();
$payment->setIntent('sale')
	->setPayer($payer)
	->setRedirectUrls($redirectUrls)
	->setTransactions([$transaction]); 

try {
	$payment->create($paypal);
} catch(Exception $e) {
	die($e->getData());
}

$approvalUrl = $payment->getApprovalLink();

header('location: '.$approvalUrl); 

}

?>