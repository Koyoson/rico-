<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our breed table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM microchip_details ORDER BY microchip_no LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$microchip_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of breeds, this is so we can determine whether there should be a next and previous button
$num_microchip_details = $pdo->query('SELECT COUNT(*) FROM microchip_details')->fetchColumn();
?>

<?=template_header('microchip_details')?>

<div class="content read">
	<h2>Read records</h2>
	<a href="create.php" class="create-record">Create record</a>
	<table>
        <thead>
            <tr>
                <td>Microchip No</td>
                <td>Dog Registration No</td>
                 <td>Implanted By </td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($microchip_details as $microchip_details): ?>
            <tr>
                <td><?=$microchip_details['microchip_no']?></td>
                <td><?=$microchip_details['dog_reg_no']?></td>
                <td><?=$microchip_details['implanted by']?></td>

      
                <td class="actions">
                    <a href="update.php?id=<?=$microchip_details['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$microchip_details['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
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