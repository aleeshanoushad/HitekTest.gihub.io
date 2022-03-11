<?php


require_once "vendor/autoload.php";
require_once "config.php";
  
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
  
$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);
  
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();

// merge cells for heading
$activeSheet->mergeCells('B2:AN2');

$activeSheet->setCellValue('B2', "Test Planner");

//Create Styles Array
$styleArrayFirstRow = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

// /set  bold
$activeSheet->getStyle('B2:AN2')->applyFromArray($styleArrayFirstRow);

// 1. select the dates without duplication from the shifts table
    $sql = 'SELECT Distinct shift_period FROM `shifts`';
    $query_dates = $db->query($sql);

// 2. Loop through the dates
    $c=3;
    $name_array=[]; 
    while ($query_date = $query_dates->fetch_assoc() ) {
        
        // 3. merge the cells 
        $merge_array[3] = 'C3:F3';
        $merge_array[7] = 'G3:J3';
        $merge_array[11] = 'K3:N3';
        $merge_array[15] = 'O3:R3';
        $merge_array[19] = 'S3:V3';
        $merge_array[23] = 'W3:Z3';
        $merge_array[27] ='AA3:AD3';
        $merge_array[31] ='AE3:AH3';
        $merge_array[35] ='AI3:AL3';
      
        $activeSheet->mergeCells($merge_array[$c]);
                
        // get the merged column name
        $col = explode(":",$merge_array[$c]);

        // 4. add date to merged cell
        $activeSheet->setCellValue($col[0] ,$query_date['shift_period']);
        $activeSheet->getStyle($col[0])
                    ->getNumberFormat()
                    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY );

       
    
        // 5. find the week days and loop
        $sql_week = 'SELECT id  FROM `shifts` where shift_period ="'.$query_date['shift_period'].'"';
        $query_weekdays= $db->query($sql_week);

        $count = 1;$row_count = 4;
        while ($query_weekday = $query_weekdays->fetch_assoc() AND $count <=4 ){
                // row always 4
        
            if($count == 1){
                $column_count = $c;
               
                               
            }else if($count == 2){
                $column_count = $c+1;
                                

            }else if($count == 3){

                $column_count = $c+2;
                                
            
            }else if($count == 4){
                $column_count = $c+3;               

            }
            
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column_count,4, $query_weekday['id']); 

            // 7. find the join with where date 
            $query_data = $db->query("SELECT  c.shift_id,b.shift_period,a.name,c.value FROM `equipments` a LEFT JOIN equipment_shift_mapping c ON c.equipment_id = a.id INNER JOIN shifts b ON b.id = c.shift_id WHERE c.shift_id = b.id AND b.shift_period ='".$query_date['shift_period']."' ORDER by b.shift_period");
            $i=0;
            $key_value = 0;
            while  ($query_data_feched = $query_data->fetch_assoc()  ){
                // // To remove Duplication of equipment names
                // $index = $key_value;
                
                // if(!in_array($query_data_feched['name'], $name_array, true)){

                //     $name_array[$key_value] =$query_data_feched['name'];
                //     $key_value++;

                // }
                
                // 8. increment the row
                
                $row_count++;
                // 9.check weekday in loop with the join week day , 
                if($query_weekday['id'] == $query_data_feched['shift_id']){
                    // if yes
                
                    // 10.add the value
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column_count, $row_count, $query_data_feched['value']);
                    //  added style to  cells     
                    $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($column_count, $row_count)
                                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    
                    if($query_data_feched['value'] == "Y"){

                        $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($column_count, $row_count)
                        ->getFill()->getStartColor()->setARGB('008000');
                        // green
                    }else{
                        //  blue 0000FF
                        $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($column_count, $row_count)
                        ->getFill()->getStartColor()->setARGB('0000FF');

                    }         
                               
                }else{
                    // 10.add the NULL value
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column_count, $row_count,NULL);
                }
                
                // 11. add name in Bth $column
                // $activeSheet->setCellValue('B'.$row_count, $name_array[$key_value]);
                $activeSheet->setCellValue('B'.$row_count, $query_data_feched['name']);

            }

            $count++;
        }
           
        $c=$c+4;
    }


$filename = 'planner.xlsx';
  
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');

?>