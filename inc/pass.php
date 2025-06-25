 <?php
    require_once 'inc.library.php';
    $teks = "a";
    $encPass = encrypt($teks);
    $decPass = decrypt('TWpNNU9YTnBhbVZyYnpFeU0yTXhNams9');
    echo $encPass . '<br>' . $decPass;


//  function GetMAC(){
//   ob_start();
//   system('getmac');
//   $Content = ob_get_contents();
//   ob_clean();
//   return substr($Content, strpos($Content,'\\')-20, 17);
// }
// function GetClientMac(){
//   $macAddr=false;
//   $arp='arp -n';
//   $lines=explode("\n", $arp);

//   foreach($lines as $line){
//     $cols=preg_split('/\s+/', trim($line));

//     if ($cols[0]==$_SERVER['REMOTE_ADDR']){
//       $macAddr=$cols[2];
//    }
// }

// return $macAddr;
// }
// function gma(){
//    if (isset($_SERVER['HTTP_CLIENT_IP']))
//     $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//  else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//     $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//  else if(isset($_SERVER['HTTP_X_FORWARDED']))
//     $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//  else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
//     $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//  else if(isset($_SERVER['HTTP_FORWARDED']))
//     $ipaddress = $_SERVER['HTTP_FORWARDED'];
//  else if(isset($_SERVER['REMOTE_ADDR']))
//     $ipaddress = $_SERVER['REMOTE_ADDR'];
//  else
//     $ipaddress = 'UNKNOWN';

//  $macCommandString   =   "arp " . $ipaddress . " | awk 'BEGIN{ i=1; } { i++; if(i==3) print $3 }'";

//  $mac = exec($macCommandString);

//  return ['ip' => $ipaddress, 'mac' => $mac];
// }

// function get_remote_macaddr($ip) {

//    return strtoupper(exec( "arp -a " . $ip . " | awk '{print $4 }'"));

// }
// $ipaddress = $_SERVER['REMOTE_ADDR'];
// echo 'ip: '.$ipaddress.", ".'mac_addr: '.get_remote_macaddr($ipaddress);

?>