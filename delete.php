<?php
error_reporting(0);

function delete($i, $id, $token) {
	
	$xa = curl_init();
            curl_setopt($xa, CURLOPT_URL, "https://graph.facebook.com/v3.3/".$id->data[$i]->id."/?access_token=".$token);
            curl_setopt($xa, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($xa, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($xa, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.3; en-us; SM-N900T Build/JSS15J) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30");
            $gas = curl_exec($xa);
            curl_close($xa);
            $cek = json_decode($gas);
            
            if ($cek->success == 1) {
           	echo "\e[92m[Berhasil Dihapus] => \e[39m".$id->data[$i]->message."\n";
           	}else{
           	echo "\e[91m[Gagal Dihapus] => \e[39m".$id->data[$i]->message."\n";
           	}
	
	}




$banner = "\e[36;1m                                                                                 
                                                                                 
           #         ######   
           #    #             
  ######   #    #  ########## 
           #    #  #        # 
           #######        ##  
##########      #       ##    
                #     ##      
                              
                                                                                 
[#] Mass Delete Facebook Status [#]    
                                   
Coded by : Revan AR                  
Team     : IndoSec                   
Github   : https//github.com/revan-ar/\n\n\e[0;1m";
                                                                                 
                                                                                                                                                                 
sleep(3);
echo $banner;
sleep(2);
echo "Masukan Access Token : ";
$token = trim(fgets(STDIN));
$name = file_get_contents("https://graph.facebook.com/v3.3/me/?fields=name&access_token=".$token);
$get_name = json_decode($name);
sleep(1);
if ($get_name->name != null) {
	echo "\n\nHalo ".$get_name->name."\nSilahkan tunggu...\n";
	sleep(2);
	$get_status = file_get_contents("https://graph.facebook.com/v3.3/me/feed/?&access_token=".$token."&limit=200");
	$id = json_decode($get_status);
	echo "\n\n";
	
	for ($i=0; $i <= 200; $i++) {
		
		if (!empty($id->data[$i]->message)) {
			delete($i, $id, $token);
			}
		}
	
	}else{
		echo "Token Salah\n";
		}
