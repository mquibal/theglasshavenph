<?php 
session_start();
require '../vendor/autoload.php';
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

require_once "paypal/start.php";
require_once "connect.php";

if(!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])) {
	die();
}

if((bool)$_GET['success'] === false) {
	die();
}

$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

$payment = Payment::get($paymentId, $paypal);
$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try {
	$result = $payment->execute($execute, $paypal);
	$result = json_decode($result);
	$trans_code = $result->transactions[0]->invoice_number;
	foreach($result->payer->payer_info->shipping_address as $key => $address_piece) {
		if($key != 'recipient_name') {
			$address_array[] = $address_piece;
		}
	}
	$address = implode(' ', $address_array);
} catch(Execption $e) {
	print_r($e->getData());
	die();
}

$user_id = $_SESSION['user']['id'];
$purchase_date = date("Y-m-d G:i:s");
$status_id = 1;
$payment_mode_id = 2;
$address = $_SESSION['address'];

$sql_query = "INSERT INTO orders (user_id, transaction_code, purchase_date, status_id, payment_mode_id) VALUES ('$user_id', '$trans_code', '$purchase_date', '$status_id', '$payment_mode_id');";
$result = mysqli_query($conn, $sql_query);

$new_order_id = mysqli_insert_id($conn); 


if($result){
	foreach($_SESSION['cart'] as $item_id => $qty){
		$item_query = "SELECT price FROM items WHERE id = '$item_id';";
		$item_result = mysqli_query($conn, $item_query);
		$item = mysqli_fetch_assoc($item_result);

		$sql = "INSERT INTO orders_items (order_id, item_id, quantity, price) VALUES ('$new_order_id', '$item_id', '$qty', '". $item['price']. "');";
		$ord_detail_result = mysqli_query($conn, $sql);
	}
} 

unset($_SESSION['cart']);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//load composer's autoloader (this allows us to use any other files composer needs)
require "../vendor/autoload.php";

//Create a new instance of phpmailer.
$mail = new PHPMailer(true);

//Email contents:
$staff_email = 'theglasshavenph@gmail.com'; //This is the email you created earlier
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
	//Make your mailer work. use your personal email to test.

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
unset($_SESSION['address']);
mysqli_close($conn);
$_SESSION['trans_code'] = $trans_code;
header('location: ../views/confirmation.php');

?>