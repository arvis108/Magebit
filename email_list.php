<?php 
require_once ('includes/databasecontroll.php');
session_start();
//email deleting
if (!empty($_GET["action"]) && $_GET["action"] == 'del') {
    if(is_numeric($_GET["email_id"])){
        $query = "DELETE FROM emails WHERE email_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$_GET["email_id"]]);
    }
}
//var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            $query = 'SELECT * FROM emails';
            if(isset($_POST['order'])) {
                //selecting sorting option
                $order = $_POST['kartot'];
                $_SESSION['order'] = $order;
                $_SESSION['ordered'] = true;
                if(isset($_SESSION['filtered'])){
                    //if before sorting was filtering, do both
                    $query .= " where (SUBSTRING_INDEX(SUBSTR(email, INSTR(email, '@') + 1),'.',1)) != '{$_SESSION['filter']}' ORDER BY {$order}";
                    unset($_SESSION['ordered']);
                }else{
                    //else do only sorting
                    $query .= " ORDER BY {$order}";
                }
                //leaving echo for easy visual understanding of sql query
                echo "<p>$query</p>";
            } 
            if (isset($_POST['filter'])) {
                //selecting filtering option
                $filter = $_POST['filter'];
                $_SESSION['filter'] = $filter;
                $_SESSION['filtered'] = true;
                if(isset($_SESSION['ordered'])){
                    //if before filtering was sorting, do both
                    $query .= " where (SUBSTRING_INDEX(SUBSTR(email, INSTR(email, '@') + 1),'.',1)) != '$filter' ORDER BY {$_SESSION['order']}";
                    unset($_SESSION['filtered']);
                }else{
                    //else do only filtering
                $query .= " where (SUBSTRING_INDEX(SUBSTR(email, INSTR(email, '@') + 1),'.',1)) != '$filter'";
                }
                //leaving echo for easy visual understanding of sql query
                echo "<p>$query</p>";
            }
            if (!isset($_POST['order']) && !isset($_POST['filter'])) {
                //if there is no sorting or filtering, by default sort by date
                $query = 'SELECT * FROM emails ORDER BY date';
                session_unset();
            }
            $stmt = $conn->prepare($query);
            $stmt->execute();
            while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                
                    <td><?php echo " <input type='checkbox' name='data[]' value='{$result['email_id']}' />"; ?></td>
                    <td><?php echo $result["email_id"]; ?></td>
                    <td><?php echo $result["email"]; ?></td>
                    <td><?php echo $result["date"]; ?></td>
                    <td><a href="email_list.php?action=del&email_id=<?php echo $result["email_id"]; ?>">
                            <img src="images/icon-delete.png" alt="Remove Item" />
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
    </table>
    <input type="submit" name="export" value="Export">
    </form>

</body>
</html>