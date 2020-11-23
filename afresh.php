<html>
   
   <head>
      <title>Update a Record </title>
   </head>
   
   <body>
      <?php
         if(isset($_POST['update'])) {
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            
            $conn = mysql_connect($dbhost, $dbuser, $dbpass);
            
            if(! $conn ) {
               die('Could not connect: ' . mysql_error());
            }
            
            $id = $_POST['id'];
            $name = $_POST['name'];
            
            $sql = "UPDATE breed ". "SET name = $name ". 
               "WHERE id = $id" ;
            mysql_select_db('rico');
            $retval = mysql_query( $sql, $conn );
            
            if(! $retval ) {
               die('Could not update data: ' . mysql_error());
            }
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
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
            <?php
         }
      ?>
      
   </body>
</html>