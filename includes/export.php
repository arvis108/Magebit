<?php
require_once ('databasecontroll.php');
//ifno about export taken from
//https://www.semicolonworld.com/php/tutorial/export-data-to-csv-php
if (isset($_POST['export'])) {
    //var_dump($_POST);
    $query = "SELECT * FROM emails WHERE";
    $data = $_POST['data'];
    foreach ($data as $value) {
        //creating query to get all selected email data
        $query .= ' email_id = ? or';
    }
    //removes useless 'or' at query end
    $query = substr_replace($query, "", -3);
    $stmt = $conn->prepare($query);
    $stmt->execute($data); 
    if($stmt->rowCount() > 0){
        $delimiter = ",";
        $filename = "emails_" . date('Y-m-d') . ".csv";
        
        //create a file pointer
        $f = fopen('php://memory', 'w');
        
        //set column headers
        $fields = array('ID', 'Email', 'Date');
        fputcsv($f, $fields, $delimiter);
        
        //output each row of the data, format line as csv and write to file pointer
        while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
            $lineData = array($result['email_id'], $result['email'], $result['date']);
            fputcsv($f, $lineData, $delimiter);
        }
        
        //move back to beginning of file
        fseek($f, 0);
        
        //set headers to download file rather than displayed
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        
        //output all remaining data on a file pointer
        fpassthru($f);
    }
    exit;
}
