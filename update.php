<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the breed id exists, for example update.php?id=1 will get the breed with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
    
        // Update the record
        $stmt = $pdo->prepare('UPDATE breed SET id = ?, name = ? WHERE id = ?');
        $stmt->execute([$id, $name]);
        $msg = 'Updated Successfully!';
    }
    // Get the breed from the breed table
    $stmt = $pdo->prepare('SELECT * FROM breed WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $breed = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$breed) {
        exit('breed doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
    <h2>Update breed record #<?=$breed['id']?></h2>
    <form action="update.php?id=<?=$breed['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="1" value="<?=$breed['id']?>" id="$id">
        <input type="text" name="name" placeholder="Mzee Pepe" value="<?=$breed['name']?>" id="$name">
       
        <input type="submit" value="Update">
         <a href="create.php" class="create-record"> Go Back </a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
