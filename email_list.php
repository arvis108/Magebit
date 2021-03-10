<?php 
require_once ('includes/databasecontroll.php');
define("PERPAGE_LIMIT",10);
session_start();
//email deleting
if (!empty($_GET["action"]) && $_GET["action"] == 'del') {
    if(is_numeric($_GET["email_id"])){
        $query = "DELETE FROM emails WHERE email_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$_GET["email_id"]]);
    }
}
function getEmails($conn) {
    $sql = 'SELECT * FROM emails';
            if(isset($_POST['order'])) {
                //selecting sorting option
                $order = $_POST['kartot'];
                $_SESSION['order'] = $order;
                $_SESSION['ordered'] = true;
                if(isset($_SESSION['filtered'])){
                    //if before sorting was filtering, do both
                    $sql .= " where (SUBSTRING_INDEX(SUBSTR(email, INSTR(email, '@') + 1),'.',1)) != '{$_SESSION['filter']}' ORDER BY {$order}";
                    unset($_SESSION['ordered']);
                }else{
                    //else do only sorting
                    $sql .= " ORDER BY {$order}";
                }
                //leaving echo for easy visual understanding of sql query
                echo "<p>$sql</p>";
            } 
            if (isset($_POST['filter'])) {
                //selecting filtering option
                $filter = $_POST['filter'];
                $_SESSION['filter'] = $filter;
                $_SESSION['filtered'] = true;
                if(isset($_SESSION['ordered'])){
                    //if before filtering was sorting, do both
                    $sql .= " where (SUBSTRING_INDEX(SUBSTR(email, INSTR(email, '@') + 1),'.',1)) != '$filter' ORDER BY {$_SESSION['order']}";
                    unset($_SESSION['filtered']);
                }else{
                    //else do only filtering
                $sql .= " where (SUBSTRING_INDEX(SUBSTR(email, INSTR(email, '@') + 1),'.',1)) != '$filter'";
                }
                //leaving echo for easy visual understanding of sql query
                echo "<p>$sql</p>";
            }
            if (!isset($_POST['order']) && !isset($_POST['filter'])) {
                //if there is no sorting or filtering, by default sort by date
                $sql = 'SELECT * FROM emails ORDER BY date';
                session_unset();
            }

    // everything for pagination
    //thanks google(https://phppot.com/php/php-pagination/#:~:text=PHP%20pagination%20cause%20with%20a%20limited%20number%20of,results%20within%20the%20single%20scope%20of%20user%E2%80%99s%20display.)
    $currentPage = 1;
    if(isset($_GET['pageNumber'])){
    $currentPage = $_GET['pageNumber'];
    }
    $startPage = ($currentPage-1)*PERPAGE_LIMIT;
    if($startPage < 0) {
        $startPage = 0;
    }
    $href = "/magebit/email_list.php?";
    
    //adding limits to select query
    $query =  $sql . " limit " . $startPage . "," . PERPAGE_LIMIT; 
    $result = $conn->prepare($query);
    $result->execute();
    while($row=$result->fetch(PDO::FETCH_ASSOC)) {
    $emails[] = $row;
    }
    
    if(is_array($emails)){
    $emails["page_links"] = paginateResults($sql,$href,$conn);
    return $emails;
    }
    }
    
    //function creates page links
    function pagination($count, $href) {
    $output = '';
    if(!isset($_REQUEST["pageNumber"])) {
        $_REQUEST["pageNumber"] = 1;
    }
    if(PERPAGE_LIMIT != 0){
    $pages  = ceil($count/PERPAGE_LIMIT);
    }
    
    //if pages exists after loop's lower limit
    if($pages>1) {
        if(($_REQUEST["pageNumber"]-3)>0) {
            $output = $output . '<a href="' . $href . 'pageNumber=1" class="page">1</a>';
        }
        if(($_REQUEST["pageNumber"]-3)>1) {
            $output = $output . '...';
        }
    
    //Loop for provides links for 2 pages before and after current page
    for($i=($_REQUEST["pageNumber"]-2); $i<=($_REQUEST["pageNumber"]+2); $i++)	{
        if($i<1) continue;
        if($i>$pages) break;
        if($_REQUEST["pageNumber"] == $i){
            $output = $output . '<span id='.$i.' class="current">'.$i.'</span>';
        } else	{    
            $output = $output . '<a href="' . $href . "pageNumber=".$i . '" class="page">'.$i.'</a>';
        }			

    }
    
    //if pages exists after loop's upper limit
    if(($pages-($_REQUEST["pageNumber"]+2))>1) {
    $output = $output . '...';
    }
    if(($pages-($_REQUEST["pageNumber"]+2))>0) {
    if($_REQUEST["pageNumber"] == $pages){
        $output = $output . '<span id=' . ($pages) .' class="current">' . ($pages) .'</span>';
    }else	{
        $output = $output . '<a href="' . $href .  "pageNumber=" .($pages) .'" class="page">' . ($pages) .'</a>';
    }			
    }
    
    }
    return $output;
    }
    
    //function calculate total records count and trigger pagination function	
    function paginateResults($sql, $href,$conn) {
        $result = $conn->prepare($sql);
        $result->execute();
        $count=$result->rowCount();
        $page_links = pagination($count, $href);
        return $page_links;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/email_list_styles.css">
    <title>Email Listing</title>
</head>
<body>

    <table  style="width: 80%; margin:0 auto;">
        <h1>Email list</h1>
        <div id="kartot-produktus" style="width: 80%;
                                            height: 50px;
                                            margin: 0 auto;
                                            display: flex;
                                            align-items: center;
                                            justify-content: flex-end;">
        <form method="POST" class="kartot">
            <label for="kartot">Sort by:</label>
            <select name="kartot" size="1">
                <option value="email ASC"> Name-ASC </option>
                <option value="email DESC"> Name-DESC </option>
                <option value="date ASC"> Date-ASC </option>
                <option value="date DESC"> Date-DESC </option>
            </select>
            <input type="submit" name="order" value="Sort" />
        </form>
    </div>
    <h4>Hide email providers</h4>
        <form method="POST" class="filter">
        <?php 
        //filter email addresses by email providers
        //sql returns list of unique email provider domains
            $query = "select DISTINCT (SUBSTRING_INDEX(SUBSTR(email, INSTR(email, '@') + 1),'.',1)) as DomainName from emails";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
                $email = $result['DomainName'];
                echo "<input type='submit' name='filter' value='$email'/>";
            }      
        ?>
        </form>
        <form action="includes/export.php" method="POST">
            <tr>
                <th style="text-align:left;">Export</th>
                <th style="text-align:left;">Email ID</th>
                <th style="text-align:left;">Email</th>
                <th style="text-align:left;">Date</th>
                <th style="text-align:left;">Delete</th>
            </tr>
            <?php
            //default sql
            
            $emails = getEmails($conn);
                if(is_array($emails)) {
                for($i=0;$i<count($emails)-1;$i++) {
                ?>
                <tr>
                
                    <td><?php echo " <input type='checkbox' name='data[]' value='{$emails[$i]['email_id']}' />"; ?></td>
                    <td><?php echo  $emails[$i]["email_id"]; ?></td>
                    <td><?php echo  $emails[$i]["email"]; ?></td>
                    <td><?php echo  $emails[$i]["date"]; ?></td>
                    <td><a href="email_list.php?action=del&email_id=<?php echo $emails[$i]["email_id"]; ?>">
                            <img src="images/icon-delete.png" alt="Remove Item" />
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
    </table>
    <div class="pages">
<tr class="tableheader">
<td colspan="2"><?php echo $emails["page_links"]; ?></td>
</tr>
<span>page</span>
</div>
<?php
}
?>
<p>Export to CSV (will download CSV)</p>
    <input type="submit" name="export" value="Export" class="export_btn">
    </form>

</body>
</html>