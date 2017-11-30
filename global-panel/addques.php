<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/VotingPool.php';?>
<?php
     if (!Session::get('level') == '0') { 
        echo "<script>window.location = 'index.php';</script>";
     }
?>

<?php
    $pool = new VotingPool();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $insertData = $pool->addQuestion($_POST);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Question</h2>
               <div class="block copyblock"> 

               <p style="text-align: center;">
                  <?php
                     if (isset($insertData)) {
                         echo $insertData;
                     }
                   ?>
               </p>

                 <form action="" method="POST">
                    <table class="form">	

                        <tr>
                            <td>
                                <label>Enter Question</label>
                            </td>
                            <td>
                                <input type="text" name="question" placeholder="Enter Question..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Status</label>
                            </td>
                            
                            <td>
                                <select name="status">
                                  <option value="0">in-active</option>
                                </select>
                            </td>
                        </tr>
                        
                        
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>