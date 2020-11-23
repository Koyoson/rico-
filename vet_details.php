<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our breed table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM vet_details ORDER BY kvb_no LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$vet_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of breeds, this is so we can determine whether there should be a next and previous button
$num_microchip_details = $pdo->query('SELECT COUNT(*) FROM vet_details')->fetchColumn();
?>

<?=template_header('vet_details')?>

<div class="content read">
	<h2>Read records</h2>
	<a href="create.php" class="create-record">Create record</a>
	<table>
        <thead>
            <tr>
                <td>KVB No</td>
                <td>Name<td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vet_details as $vet_details): ?>
            <tr>
                <td><?=$vet_details['kvb_no']?></td>
                <td><?=$vet_details['name']?></td>
             
      
                <td class="actions">
                    <a href="update.php?id=<?=$vet_details['kvb_no']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$vet_details['kvb_no']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </tdmicrochip_details            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

     <a href="create.php" class="create-record"> Go Back </a>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_breed): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>