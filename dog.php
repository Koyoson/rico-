<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our deworming  table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM dog ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$dog = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of breeds, this is so we can determine whether there should be a next and previous button
$num_dog = $pdo->query('SELECT COUNT(*) FROM dog')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Read records</h2>
	<a href="dog.php" class="create-record">Create Dog record</a>
	<table>
        <thead>
            <tr>
                <td>Registration No.</td>
                <td>Breed Id</td>
                <td>Description</td>
                <td>Date Of Birth </td>
                <td>Gender</td>
                <td>Registration Name</td>
                <td></td>
            </tr> 
        </thead>
        <tbody>
            <?php foreach ($dog as $dog): ?>
            <tr>
                <td><?=$dog['reg_no']?></td>
                <td><?=$dog['breed_id']?></td>
                <td><?=$dog['description']?></td>
                <td><?=$dog['dob']?></td>
                <td><?=$dog['gender']?></td>
                <td><?=$dog['reg_name']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$dog['reg_no']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$dog['reg_no']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
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
		<?php if ($page*$records_per_page < $num_dog): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>