<?php

function bandwidth()  {
    $rx_file = '/sys/class/net/eth0/statistics/rx_bytes';
    $tx_file = '/sys/class/net/eth0/statistics/tx_bytes';
    $rx_file_open = fopen($rx_file,'r');
    $tx_file_open = fopen($tx_file,'r');
    $rx_value_old = fgets($rx_file_open);
    $tx_value_old = fgets($tx_file_open);
    fclose($rx_file_open);
    fclose($tx_file_open);
    sleep(1);
    $rx_file_open_new = fopen($rx_file,'r');
    $tx_file_open_new = fopen($tx_file,'r');
    $rx_value_new = fgets($rx_file_open_new);
    $tx_value_new = fgets($tx_file_open_new);
    fclose($rx_file_open_new);
    fclose($tx_file_open_new);


    $rx_vae = ($rx_value_new - $rx_value_old) / 1024 * 8;
    $tx_vae = ($tx_value_new - $tx_value_old) / 1024 * 8;
    echo "The eth0 Input is: $rx_vae KB/bps.  Ouput is: $tx_vae KB/bps.";
}

   while (1)   {

        bandwidth();
        echo "\n";
   }
      


?>
