<?php
$uArray = []; 
$code=$_POST["code"];
$icode=$_POST["icode"];
$api="AIzaSyBb-JN2-laW4W859lgNskoNSKAmYmySNIA";
$spreadsheet=$_POST["spreadsheet"];
$collumn=$_POST["columntitle"];
$ncol=$_POST["columnnumber"];
$ch=$_POST["group"];
$ucode=$_POST["uc"];

if($ucode=NULL){
$tlink="https://api.pwrtelegram.xyz/user".$icode."/completephonelogin?code=".$code;
$fauth=file_get_Contents($tlink);
$fathArray=json_decode($fauth);
$fauthArray=(object)$fathArray;
if($fauth!=NULL) $ucode=$fauthArray->result;
else echo "<br>WRONG VERIFICATION CODE, LOGIN AGAIN FROM START<br>";}





$added=0;
$k=$ncol-1;


$ilink="https://api.pwrtelegram.xyz/user".$ucode."/channels.inviteToChannel?channel=".$ch."&users=";



function url_get_contents ($Url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}



function add($userArray,$ch,$ucode,$k){
	$ilink="https://api.pwrtelegram.xyz/user".$ucode."/channels.inviteToChannel?channel=".$ch."&users=";
	while(1){
		$flink=$ilink."[\"".$userArray[$k]."\",\"".$userArray[$k+1]."\",\"".$userArray[$k+2]."\",\"".$userArray[$k+3]."\",\"".$userArray[$k+4]."\"]";
    $Updates =url_get_Contents($flink);
	$updArray=json_decode($Updates);
	$upd=(object) $updArray;
	if(!$upd->ok) { echo "<br><h2>RE_LOGIN BECAUSE:</h2></br>"; echo $upd->description; echo "<br>"; check($ucode,$ch,$userArray,$k); break;}
	$k=$k+5;
	}
}




function check($ucode,$ch,$uArray,$start){
$start=$start-4;
while(1){
$checklink="https://api.pwrtelegram.xyz/user".$ucode."/channels.getParticipants?channel=%22".$ch."%22&filter={%22_%22:%20%22channelParticipantsSearch%22,%20%22q%22:%20%22".$uArray[$start]."%22}&offset=3&limit=50&hash=3";

$lol=url_get_contents($checklink);
$kekArray=json_decode($lol);
$lolArray=(object) $kekArray;
$kek=$lolArray->result->count;
if($kek==1){$start=$start+1; continue;}
else {break;}
}//end of while
$fstart=$start+2;

echo "<br><h3> Please begin from $fstart row number</h3>";
echo "<br> <h3>Ucode is $ucode</h3>";
}//end of function start



$call="https://sheets.googleapis.com/v4/spreadsheets/".$spreadsheet."?includeGridData=true&ranges=Telegram!".$collumn."%3A".$collumn."&key=".$api;
$data=file_get_Contents($call);

$dataArray = json_decode($data, true);
$i=0;
$outerArray=$dataArray['sheets'][0]['data'][0]['rowData'];
foreach($outerArray as $tmp)
{ 
	$uArray[$i]=$tmp['values'][0]['userEnteredValue']['stringValue'];
	
	
	$i=$i+1;
}
add($uArray,$ch,$ucode,$k);

echo "<br><h3>Thanks for using the bot</h3>";

?>