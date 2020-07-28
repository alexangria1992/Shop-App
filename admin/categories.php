<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/PHP-Shop-Good-Copy/Shop-App/core/init.php';
    include 'includes/head.php';
    include 'includes/navigation.php';
    
    $sql ="SELECT * FROM categories WHERE parent = 0 ";
    $result = $db->query($sql);
    $errors = array();

    //Process Form 
    if(isset($_POST) && !empty($_POST)){
        $parent = sanitize($_POST['parent']);
        $category = sanitize($_POST['category']);
        $sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$parent'";
        $formResult = $db->query($sqlform);
        $count = mysqli_num_rows($formResult);
        //if category is blank
        if($category == ''){
            $errors[] .= 'The category cannot be left blank. ';
        }
         //If Exists in database
         if($count > 0 ){
             $errors[] .= $category. ' already exists. Please choose new category';
         }

         //Display Errors or Update Database

         if(!empty($errors)){
           //Display Errors
           $display = display_errors($errors); ?>
        <script>
         $('document').ready(function(){
             $('#errors').html('<?php echo $display; ?>');
         })
        </script>
       <?php  } else {
            //Update database
          $updatesql = "INSERT INTO categories (category, parent) VALUES ('$category', '$parent')";
          $db->query($updatesql);
          header('Location: categories.php');
         }
    }


?>
<h2 class="text-center">Categories</h2>
<div class="row">
  

    <!-- Form -->
    <div class="col-md-6">
        <form action="categories.php" class="form" method="post">
        <legend>Add a Category</legend>
        <div id="errors"></div>
            <div class="form-group">
             <label for="parent">Parent</label>
                <select name="parent" id="parent" class="form-control">
                    <option value="0">Parent</option>
                    <?php while($parent = mysqli_fetch_assoc($result)): ?>
                    <option value="<?php echo $parent['id']; ?>"><?php echo $parent['category']; ?></option>
                    <?php endwhile; ?>
                 </select>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control" id="category">
            </div>
            <div class="form-group">
            <input type="submit" value="Add Category" class="btn btn-success">
            </div>
        </form>
    </div>
    <!-- Category Table -->
    <div class="col-md-6">
        <table class="table table-bordered">
        <thead><th>Category</th>
               <th>Parent</th>
               <th></th>
        </thead>
        <tbody>
        <?php
         $sql ="SELECT * FROM categories WHERE parent = 0 ";
         $result = $db->query($sql);
        while($parent = mysqli_fetch_assoc($result)): 
            $parent_id = (int)$parent['id'];
            $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
            $childResult = $db->query($sql2);

        ?>
            <tr class="bg-primary">
                 <td><?php echo $parent['category']; ?></td>
                 <td>Parent</td>
                 <td>
                 <a href="categories.php?edit=<?php echo $parent['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                 <a href="categories.php?delete=<?php echo $parent['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>

                 </td>
            </tr>
            <?php while($child = mysqli_fetch_assoc($childResult)): ?>
                <tr class="bg-info">
                 <td><?php echo $child['category']; ?></td>
                 <td><?php echo $parent['category']; ?></td>
                 <td>
                 <a href="categories.php?edit=<?php echo $child['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                 <a href="categories.php?delete=<?php echo $child['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>

                 </td>
            </tr>
            <?php endwhile; ?>

            <?php endwhile; ?>
        </tbody>

        </table>
    </div>
</div>
<?php include 'includes/footer.php';