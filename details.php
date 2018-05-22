
<html>
<body>

<?php
$phone=$_POST["phone"];
$purl="$phone";
$ur="https://api.pwrtelegram.xyz/phonelogin?phone=".$purl;

$temp=file_get_Contents($ur);
$tempArray = json_decode($temp);
if($tempArray!=NULL)
$icode=$tempArray->result;
else echo "<h1> INCORRECT NUMBER </h1>";
echo "<br>";

?>


<form action="array.php" method="post">
VERIFICATION CODE: <input type="text" name="code"><br>

Spreadsheet ID: <input type="text" name="spreadsheet"><br>
Column(Eg: A,B,C,D etcetra) of username column: <input type="text" name="columntitle"><br>
Row Number: <input type="text" name="columnnumber"><br>
Telegram group Invite link: <input type="text" name="group"><br>
Ucode(optional): <input type="text" name="uc"><br>
<input type="hidden" name="icode" value="<?php echo $icode;?>" /><br>
<input type="submit">
</form>

</body>
</html>
