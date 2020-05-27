<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM item WHERE CONCAT_WS(Item_ID,StartDate,EndDate,StartingPrice,Title,Description,Category,User_ID) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM item";
    $search_result = filterTable($query);
}

function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "bidwebpagedatabase");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Keresés</title>
    </head>
    <body>
        
        <form action="search.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Keres"><br><br>
            <table>
                <tr>
                    <th>Id</th>
                    <th>StartDate</th>
                    <th>EndDate</th>
                    <th>StartingPrice</th>
					<th>Title</th>
					<th>Description</th>
					<th>Category</th>
					<th>User_ID</th>
                </tr>

                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['Item_ID'];?></td>
                    <td><?php echo $row['StartDate'];?></td>
                    <td><?php echo $row['EndDate'];?></td>
                    <td><?php echo $row['StartingPrice'];?></td>
					<td><?php echo $row['Title'];?></td>
					<td><?php echo $row['Description'];?></td>
					<td><?php echo $row['Category'];?></td>
					<td><?php echo $row['User_ID'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>