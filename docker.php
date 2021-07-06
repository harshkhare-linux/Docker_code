<?php 
// error_reporting(~0);
// ini_set('display_errors', 1);
$email = isset($_POST['email']) ? $_POST['email'] : "";
$n=8; 
function getName($email) { 
    if (empty($email)) 
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
      
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    } else {
        $email_array = explode("@", $email);
        $email = $email_array[0];
        return $email;
    }
}

//echo getName($n); 
$char = getName($email);
//echo $char;
$domain= $char.'.techlinux.online';
//$domain= techlinux.online/$char;
echo $domain;
// echo "---";
$registered_domain_list = file_get_contents("/var/www/html/domain_list.json");
// var_dump($registered_domain_list);

if( !empty($registered_domain_list) )
	$registered_domain_list = json_decode($registered_domain_list, true);
// var_dump($registered_domain_list);
// echo "---";
if( empty($registered_domain_list) || !is_array($registered_domain_list) )
{
	$registered_domain_list = array();
}

if( !isset( $registered_domain_list[$email] ) )
{
	echo "NEW USER DEMO";
	$registered_domain_list[$email]['domain'] = $domain;
	// var_dump($registered_domain_list);
	file_put_contents( "/var/www/html/domain_list.json", json_encode($registered_domain_list) ) ;
	// die("HELLO");
	$output = var_dump(shell_exec('RET=` docker run -dit  --name '.$domain.'  -e letsencrypt_email=utkarsh.sharma6@gmail.com -e LETSENCRYPT_HOST='.$domain.' -e VIRTUAL_HOST='.$domain.'  harshkhare/worpdress:20`;echo $RET'));
	// echo $output;
	sleep(10);
	$output = var_dump(shell_exec('RET=`docker exec --tty '.$domain.'  /etc/init.d/mysql start `;echo $RET')); echo $output;
	//$output1 = var_dump( shell_exec('RET=`docker exec -it shubham.techlinux.online bash -c  _POST=shubham php /var/www/html/wordpress/test2.php`;echo $RET'));echo $output1;
	//$output1 = var_dump( shell_exec('RET=`docker exec -it shubham.techlinux.online   mysql -u newuser -ppassword -e   --skip-grant-tables UPDATE wordpress.wp_options SET option_value=http://newddsfdsf/wordpress WHERE option_name = home`;echo $RET'));echo $output1

	//$output1 = var_dump( shell_exec('RET=`docker exec -it shubham.techlinux.online   mysql -u root  -ppassword -e  echo $RET')); echo $output;

	$output1 = shell_exec('RET=`docker exec --tty '.$domain.'  php /var/www/html/wordpress/final.php '.$domain.' harsh` ;echo $RET');
	print_r($output1);
        sleep(15);

	//$output = shell_exec('RET=`sudo docker exec -it  shubham.techlinux.online  mysql -n wordpress -u root -ppassword -e -s "http://example.com/yourblog"  -r "http://newdomain.com""`;echo $RET')

	//$output = shell_exec('RET=`sudo docker exec '.$domain.' mysql -u root -ppassword -e {UPDATE wordpress.wp_options SET option_value="http://'.$domain.'" WHERE option_name="home"}`;echo $RET'); echo $output;
	//sleep(10);
	//$output = var_dump(shell_exec('RET=`docker exec -it '.$domain.' service apache2 restart `;echo $RET')); echo $output;
	//$output = var_dump(shell_exec('RET=`sudo docker exec -it '.$domain.' /etc/init.d/mysql start `;echo $RET')); echo $output;
	//$output = var_dump(shell_exec('sudo docker exec -dit techlinux.online sed -i 's/http://example2.com//$domain/gI' /var/www/html/wordpress/wp-twentytwentyone/functions.php')); echo $output;
	//$output = var_dump(shell_exec('RET=`sudo docker exec -it '.$domain.' wp --info --allow-root`;echo $RET'));echo $output;



	//$output = shell_exec('RET=`sudo docker exec '.$domain.' magento setup:store-config:set --base-url=http://'.$domain.'`;echo $RET'); echo $output;
	///$output = shell_exec('RET=`sudo docker exec '.$domain.' magento setup:store-config:set --base-url-secure=https://'.$domain.'`;echo $RET'); echo $output;
	//$output = shell_exec('RET=`sudo docker exec '.$domain.' magento setup:store-config:set --base-url=https://'.$domain.'`;echo $RET'); echo $output;
	///$output = shell_exec('RET=`sudo docker exec -it '.$domain.' magento  cache:flush `;echo $RET'); echo $output;
	//$output = shell_exec('RET=`sudo docker inspect '.$domain.' | grep HostPort `;echo $RET'); echo $output;
	//$a = HostPort($n);
	//echo $a
	//header("Location: http://$domain");
	echo '</br><a class="button" href="https://'. $domain .'" target="_blank" >Click Here to Open Site </a> ';
}
else
{
	echo "ALREADY REGISTERED USER DEMO";
	echo '</br><a class="button" href="https://'. $domain .'" target="_blank" >Click Here to Open Site </a> ';
}

$msg = "Demo scheduled - eBay Integration for WooCommerce\nUser email - $email";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);
$headers = "From: demo@cedcommerce.com" . "\r\n" .
"CC: nitishupadhyay@cedcommerce.com";
// send email
mail("shubhamagarwal@cedcommerce.com","CedCommerce - Demo Scheduled",$msg, $headers);
?>
