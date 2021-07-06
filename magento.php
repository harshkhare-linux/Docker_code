<?php 
$n=8; 
function getName($n) { 
    $characters = 'abcdefghijklmnopqrstuvwxyz'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 

    return $randomString; 
}

//echo getName($n); 
$char = getName($n);
//echo $char;
$domain= $char.'.techlinux.online';
//$domain= techlinux.online/$char;
echo $domain;
$output = var_dump(shell_exec('RET=` docker run -dit  --name '.$domain.' -e letsencrypt_email=utkarsh.sharma6@gmail.com -e LETSENCRYPT_HOST='.$domain.' -e VIRTUAL_HOST='.$domain.' utkarsh24695/binary:latest`;echo $RET'));
// echo $output;
sleep(10);
$output = var_dump(shell_exec('RET=`docker exec -it '.$domain.'  /etc/init.d/mysql start `;echo $RET')); echo $output;

$output = shell_exec('RET=`docker exec --tty '.$domain.' magento setup:store-config:set --base-url=http://'.$domain.'`;echo $RET'); echo $output;
$output = shell_exec('RET=`docker exec --tty '.$domain.' magento setup:store-config:set --base-url-secure=https://'.$domain.'`;echo $RET'); echo $output;
$output = shell_exec('RET=`docker exec --tty '.$domain.' magento setup:store-config:set --base-url=https://'.$domain.'`;echo $RET'); echo $output;
$output = shell_exec('RET=`docker exec --tty '.$domain.' magento  cache:flush `;echo $RET'); echo $output;
echo '</br><a class="button" href="https://'. $domain .'" target="_blank" >Click Here to Open Site </a> ';
sleep(15);

?>

