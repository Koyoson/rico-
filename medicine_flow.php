<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our deworming  table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM medicine_flow ORDER BY batch_no LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$medicine_flow = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of breeds, this is so we can determine whether there should be a next and previous button
$num_medicine_flow = $pdo->query('SELECT COUNT(*) FROM medicine_flow')->fetchColumn();
?>

<?=template_header('Flow ya dawa')?>

<div class="content read">
	<h2>Read records</h2>
	<a href="medicine_flow.php" class="create-record">Create  record</a>
	<table>
        <thead>
            <tr>
                <td>Batch No.</td>
                <td>Medicine Id</td>
                <td>Purchase Date</td>
                <td>Purchase Quantity </td>
                <td>Expiry Date </td>
                <td>Buying Price</td>
                <td></td>
            </tr> 
        </thead>
        <tbody>
            <?php foreach ($medicine_flow as $medicine_flow): ?>
            <tr>
                <td><?=$medicine_flow['batch_no']?></td>
                <td><?=$medicine_flow['medicine_id']?></td>
                <td><?=$medicine_flow['purchase_date']?></td>
                <td><?=$medicine_flow['purchase_quantity']?></td>
                <td><?=$medicine_flow['expiry_date']?></td>
                <td><?=$medicine_flow['buying_price']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$medicine_flow['batch_no']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$medicine_flow['batch_no']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

     <a href="dog.php" class="create-record"> Go Back </a>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="dog.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_medicine_flow): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>