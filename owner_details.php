<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our breed table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM owner_details ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$owner_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of breeds, this is so we can determine whether there should be a next and previous button
$num_owner_details = $pdo->query('SELECT COUNT(*) FROM owner_details')->fetchColumn();
?>

<?=template_header('owner_details')?>

<div class="content read">
	<h2>Read records</h2>
	<a href="create.php" class="create-record">Create record</a>
	<table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Name </td>
                 <td>Address </td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($owner_details as $owner_details): ?>
            <tr>
                <td><?=$owner_details['id']?></td>
                <td><?=$owner_details['name']?></td>
                <td><?=$owner_details['address']?></td>

      
                <td class="actions">
                    <a href="update.php?id=<?=$owner_details['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$owner_details['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>      

          </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

     <a href="create.php" class="create-record"> Go Back </a>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_owner_details): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>