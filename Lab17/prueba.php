<?
$stored_password= '$2y$10$ydEVPoNYDATXDcubeeoIY.xb.0GgcBRLfXSwcQkXb5jjVT4L3Fz0C';

	//$oldPass= password_hash('hola', PASSWORD_DEFAULT);
				   
	$password= password_hash('prueba34', PASSWORD_DEFAULT);

echo $stored_password;
echo "   ";
echo $password;



//$2y$10$Rsw.nywYY8p7wsKpu828f.jvceyIgCOPcDOkvav2e6y8bflhTTVwa
/*if(password_verify('prueba300', $stored_password)){
	echo "you are in";

}else{
 	echo "try again";
}
//echo password_hash('funciona', PASSWORD_DEFAULT);
/*$stored_password= '$2y$10$oWkRcEvLr8qxpD43xlMZtu.Os9X6uEo4lQGe6h3vWV3F.satsUs5e';
					 $2y$10$dU3WGE5f.r3MmquZjtiYaeQKS6jRzDosffIQjA3pDOze8CfF3Pjdm
					 $2y$10$DZlQeLL0ETcMj72zNr2BROuK61exPMDW2wGLu40RSuDwpHeeP2lRG
					 $2y$10$oWkRcEvLr8qxpD43xlMZtu.Os9X6uEo4lQGe6h3vWV3F.satsUs5e
if(password_verify('funciona', $stored_password)){
	echo "you are in";

}else{
 	echo "try again";
}*/
?>