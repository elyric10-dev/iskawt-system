<?php
require('db.php');
session_start();

$email_S = $_SESSION['email'];
//FETCH GOOGLE ACCOUNT

$getEmail = "SELECT * FROM user_accounts WHERE email = '$email_S'";
$getEmailQuery = mysqli_query($conn, $getEmail);
$thisEmail = $getEmailQuery->fetch_array();

?>

<style>
.line{
	height: 5px;
	top: 9.7rem;
	width: 87px;
	animation: scanning 2s linear infinite;
}
@keyframes scanning{
	0%,100%{
	top: 1.5rem;
	}
	20%{
	top: 9.7rem;
	}
}
.boxshadow{
	box-shadow: 2px 2px 10px rgba(0,0,0,0.4);
}
</style>

<div class="relative flex text-center w-full my-5">
	<span class="font-bold text-3xl mx-10">Login using QR Code</span>
</div>

<div class="relative flex justify-center">
	<div class="line absolute <?php echo ($thisEmail['qr_enabled'] === '0' )?' bg-blue-400': ' bg-red-400';?>"></div>
	<div class="boxshadow enable_qr w-36 h-36 bg-red mt-5 grid place-items-center">
	
<?php
	$code = $thisEmail['qrcode'];
	$qr2Link = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$code.'&choe=UTF-8';
	$thisLink = $qr2Link;
?>
	<img class='block qrcode rounded-full'  src= <?php echo ($thisEmail['qr_enabled'] === '0' )?' empty_qr.png': " $thisLink"?>>

</div>

</div>
<div class="qr_button w-full flex justify-center mt-16 mb-4">
	<!-- //FOR 2 ENABLE AND DISABLE BUTTONS HERE -->
	<button onclick="loadButton()" id="qrButton" type="submit" name="<?php echo ($thisEmail['qr_enabled'] === '0' )?' enableQR': ' disableQR';?>" class="boxshadow <?php echo ($thisEmail['qr_enabled'] === '0' )?' bg-blue-400': ' bg-red-400';?> py-2 px-5 rounded-lg text-white<?php echo ($thisEmail['qr_enabled'] === '0' )?' hover:bg-blue-500': ' hover:bg-red-500';?> trans-3"><?php echo ($thisEmail['qr_enabled'] === '0' )?' Enable QR': ' Disable QR ';?>
	</button>
</div>
<!-- SAVE IMAGE RIGHT NOW -->
<div class="qr_button w-full flex justify-center">
	<!-- <a target="_blank" href="<?php  echo $thisLink ?>" class="download_images bg-green-400 hover:bg-green-500 trans-3 rounded-lg py-2 px-5 cursor-pointer">Save Image</a> -->
	<button onclick="window.open('<?php  echo $thisLink ?>', '_blank'); return false;" class="boxshadow download_images bg-green-400 hover:bg-green-500 trans-3 text-white rounded-lg py-2 px-5 cursor-pointer <?php echo ($thisEmail['qr_enabled'] === '0' )?' hidden': ' ';?>">Save Image</button>
</div>
