<?php
include('../includes/database/db_controllers.php');

$totalProfit;

$rows   = $_POST["table_data"];
$totalProfit = $_POST['totalProfit'];
$bar = $_POST['bar'];
$barId = $_POST['barId'];


$current_time = date('y-m-d');

$check = selectAll('saved_data', ['DateReg' => $current_time, 'BarID' => $barId, 'Bar' => $bar]);

$num = count($check);
if($num >= 1){
    foreach($rows as $row){

$id = $row[7];
        $data = [
            'Product' => $row[0],
            'Price_per_can' => $row[1],
            'Bottles_sold' => $row[2],
            'Price_of_drink' => $row[3],
            'Gross_sale' => $row[4],
            'Cog_used' => $row[5],
            'Profit' => $row[6],
            'Total_profit' => $totalProfit,
            'DateReg' => $current_time,
            'BarID' => $barId,
            'Bar' => $bar
            
        ];
    
     
           $inventory = selectOne('inventory', ['Product' => $row[0], 'Category' => 'Beer']);
           $runCheck = selectOne('saved_data', ['DateReg' => $current_time, 'BarID' => $barId, 'Bar' => $bar, 'Product' => $row[0]]);
           $quant = $inventory['Quantity'];
           $idInv = $inventory['id'];
           $bot = $runCheck['Bottles_sold'];
            if($bot > $row[2]){
                $value = intval($bot) - intval($row[2]);
                $newInventory = intval($quant) + intval($value);
                $update_inventory = update('inventory', $idInv, ['Quantity' => $newInventory]);

                if($update_inventory){
                    update('saved_data', $id, $data);
                    echo 'success';
                }else{
                    echo 'error1';
                }
            }elseif($row[2] > $bot){
                $value = intval($row[2]) - intval($bot);
                $newInventory = intval($quant) - intval($value);
                $update_inventory = update('inventory', $idInv, ['Quantity' => $newInventory]);

                if($update_inventory){
                    update('saved_data', $id, $data);
                    echo 'success';
                }else{
                    echo 'error1';
                }
            }else{
                echo 'no way';
            }
        
       
    }
}
else{
    foreach($rows as $row){
    
        $data = [
            'Product' => $row[0],
            'Price_per_can' => $row[1],
            'Bottles_sold' => $row[2],
            'Price_of_drink' => $row[3],
            'Gross_sale' => $row[4],
            'Cog_used' => $row[5],
            'Profit' => $row[6],
            'Total_profit' => $totalProfit,
            'DateReg' => $current_time,
            'BarID' => $barId,
            'Bar' => $bar
            
        ];
    
        $result = insert('saved_data', $data);
    
        if($result){
            
           $inventory = selectOne('inventory', ['Product' => $row[0], 'Category' => 'Beer']);
          
           $quant = $inventory['Quantity'];
           $idInv = $inventory['id'];

           $new_quantity = intval($quant) - intval($row[2]);

           $update_inventory = update('inventory', $idInv, ['Quantity' => $new_quantity]);
           if($update_inventory){
            echo 'success';
           }
        }else{
            echo 'error';
        }
       
    }
}