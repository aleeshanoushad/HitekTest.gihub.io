<?php

require_once "vendor/autoload.php";
require_once "config.php";
  
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  
$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);
  
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();

// merge cells for heading
$activeSheet->mergeCells('B2:AN2');

$activeSheet->setCellValue('B2', "Test Planner");

// // Align the text to center
// $activeSheet->getStyle('B2')
//     ->getAlignment()
//     ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    // while($row = $query->fetch_assoc()) {
        
    //     $i++;

        
    //     if($period[$i-1] == $row['shift_period']){
            
    //         getActiveSheet()->setCellValue('C3', $row['shift_period'] );
    //         $shift_date =  $row['shift_period'];

    //     }else{
            
    //         $shift_array[j] = $shift_date;
    //         $shift_array[j+1] = $row['shift_period'];
            
    //     }
    //     $shift_id[] = $row['id'];

    // } // end while for shift dates

    // sheet data

    // $query_data = $db->query("SELECT a.id, c.shift_id,b.shift_period,a.name,c.value FROM `equipments` a LEFT JOIN equipment_shift_mapping c ON c.equipment_id = a.id INNER JOIN shifts b ON b.id = c.shift_id WHERE c.shift_id = b.id Group By b.shift_period ORDER by b.shift_period");
    $query_data = $db->query("SELECT a.id, c.shift_id,b.shift_period,a.name,c.value FROM `equipments` a LEFT JOIN equipment_shift_mapping c ON c.equipment_id = a.id INNER JOIN shifts b ON b.id = c.shift_id WHERE c.shift_id = b.id  ORDER by b.shift_period");
    
    if($query_data->num_rows > 0) {
        $k=5;

        $merge_array =['C3:F3','G3:J3','K3:N3','O3:S3','T3:W3','X3:AA3','AB3:AE3','AF3:AI3','AJ3:AM3'];
        $c=0;
        $column = 3;

        while($row = $query_data->fetch_assoc() ) {
            
            $names [] = $row['name'];
            $shift_id_array[] = $row['shift_id'];
            // echo "<pre>";
            // var_dump($shift_id_array);
            // echo "</pre>";

            $dates [] = $row['shift_period'];


            // 1. merge cells
            $activeSheet->mergeCells($merge_array[$c]);
            
            // get the merged column name
            $col = explode(":",$merge_array[$c]);

            // 2. add value to merged cell
            $activeSheet->setCellValue($col[0] ,$row['shift_period']);

            // 3.  extract the shift ids from shifts table
            $sql = 'SELECT id FROM `shifts` WHERE shift_period ="'.$row['shift_period'].'" ';
           
            $query_shift_ids = $db->query($sql);
            // week row = 4
            // date row = 3
        

            // 4. add the date in 3rd row after merge
            $activeSheet->setCellValue($col[0] ,$row['shift_period']);
            $count = 1;
            while($shift_ids = $query_shift_ids->fetch_assoc() AND $count <= 4){
                // find a method to set the column number
                $row_number = 4;
                
                // add the week day number in 4th row
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, $row_number, $shift_ids['id']);                

                if($shift_ids['id'] == $row['shift_id']){

                    //  if(in_array ($row['shift_id'],$shift_id_array)) {

                    //         $activeSheet->setCellValue('B'.$row_number, $row['name']);

                    //     }else{
                    //         //  its duplicate value of equipment
                    //         if(in_array ($row['name'], $names )){

                    //         }

                    //     }
                    
                    // 5. Add value to the cell
                    // 5. increment the 
                    $row_number++;
                    // set the value in that column
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, $row_number, $row['value']);

                }else{

                    $row_number++;
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, $row_number, NULL);

                }

                // adding the equipemnt name
                $activeSheet->setCellValue('B'.$row_number, $row['name']);
               
                $count++;
                $column++;
                $k++;
                
            

            }
            $c++;
           
        }

        
}

       
  
$filename = 'planner.xlsx';
  
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');

?>