<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our deworming  table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM deworming_records ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$deworming = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of breeds, this is so we can determine whether there should be a next and previous button
$num_deworming = $pdo->query('SELECT COUNT(*) FROM deworming_records')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Read records</h2>
	<a href="deworming.php" class="create-record">Create deworming record</a>
	<table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Medicine Batch Number</td>
                <td>Dog Registration No.</td>
                <td>Vet Kvb No.</td>
                <td>Deworming Date</td>
                <td></td>
            </tr> 
        </thead>
        <tbody>
            <?php foreach ($deworming_records as $deworming_records): ?>
            <tr>
                <td><?=$deworming_records['id']?></td>
                <td><?=$deworming_records['medicine_batch_no']?></td>
                <td><?=$deworming_records['dog_reg_no']?></td>
                <td><?=$deworming_records['vet_kvb_no']?></td>
                <td><?=$deworming_records['deworming_date']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$deworming_records['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$deworming_records['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

     <a href="deworming.php" class="create-record"> Go Back </a>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="deworming.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_deworming): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>