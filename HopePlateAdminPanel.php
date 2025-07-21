<?php
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> Hope Plate - Admin Panel </title>
	<link rel = "stylesheet" href = "Styles.css">
	<?php
	    require ('sessionTimeoutfunction.php'); 
	?>
</head>

<body>
	<?php
	   $showAlert = false;
	   include 'createHopePlateDatabase.php';
	  
	   if (isset($_SESSION['error_message'])) {
	       echo "<script> alert('{$_SESSION["error_message"]}'); </script>";
	       unset($_SESSION['error_message']);
	   }
	   
	   if(!isset($_SESSION['name'])) {
            header("Location: HopePlateLogin.php");
	   }
	   
	   // Initialise the default number of records
       $records = 0;	   
	  
	   // Number of records to show per page
	   $display = 10;
	   
	   // Default table selection
	   $table = isset($_GET['table']) ? $_GET['table'] : 'user_table';
	   
	   // Default the id
	   if ($table == 'user_table'){ 
	        $id = 'user_id';
	   }
	   else if ($table == 'admin_table') {
	       $id = 'admin_id';
	   }
	   
	   // Count the number of records:
	   $sql = "SELECT COUNT($id) FROM $table";
	   $result = @mysqli_query ($conn, $sql);
	   $row = @mysqli_fetch_array ($result, MYSQLI_NUM);
	   $records = $row[0];
	   
	   // Determine how many pages there are...
	   if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	       $pages = $_GET['p'];
	   }
	   else { // Need to determine.	       
	       // Calculate the number of pages...
	       if ($records > $display) { // More than 1 page.
	           $pages = ceil ($records / $display);
	       }
	       else {
	           $pages = 1;
	       }
	   } // End of p IF.
	   
	   // Determine where in the database to start returning results...
	   if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	       $start = $_GET['s'];
	   } else {
	       $start = 0;
	   }
	   
	   // Determine the sorting function
	   // Default is by user id.
	   $sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'id';
	   
	   // Determine the sorting order:
	   switch($sort) {
	       case 'id':
	           $order_by = $id . ' ASC';
	           break;
	           
	       case 'n':
	           $order_by = 'name ASC';
	           break;
	           
	       case 'e':
	           $order_by = 'email ASC';
	           break;
	           
	       case 'cn':
	           $order_by = 'phone_num ASC';
	           break;
	           
	       case 'g':
	           $order_by = 'gender ASC';
	           break;
	           
	       case 'dob':
	           $order_by = 'dob ASC';
	           break;
	           
	       case 'dr':
	           $order_by = 'register_date ASC';
	           break;
	           
	       default:
	           $order_by = 'register_date ASC';
	           $sort = 'dr';
	           break;
	   }
	   
	   // Define the query:
	   $sql = "SELECT $id, name, email, phone_num, gender, dob, DATE_FORMAT(register_date, '%d %M %Y') AS dr FROM $table
               ORDER BY $order_by LIMIT $start, $display";
	   $result = @mysqli_query ($conn, $sql); // Run the query.
	?>
    
    <div class = "header-container" style = "display: flex; justify-content: flex-start;">
		<div class = "profile-button" style = "padding: 15px;">
    		<a href = "HopePlateOptions.php">
    			<img src = "Images/Profile.png" alt = "Button_img">
    		</a>
    	</div>
    	<div class = "admin-top-nav">
    		<a href = "HopePlateProfileAdmin.php"> <?php echo $_SESSION['name'] ?> </a>
    		<a href = "HopePlateProfileAdmin.php"> Admin </a>
    	</div>
    	
    </div>
    
    <div class = "company-section" style = "height: calc(100vh - 215px);">
    	<div style = "display: flex; align-items: center; justify-content: space-between; padding-left: 10%; width: 80%;">
    		<form style = "padding-left: 60%;" method = "GET" action = "HopePlateAdminPanel.php">
                <label for = "table-select"> Select Table: </label>
                <select style = "background-color: pink; font-family: 'Comic Sans MS', Times New Roman, Inter; font-size: 15px;" 
               	id = "table-select" name = "table" onchange = "this.form.submit()">
                    <option value = "user_table" <?php if ($table == 'user_table') echo 'selected'; ?>> User Table </option>
                    <option value = "admin_table" <?php if ($table == 'admin_table') echo 'selected'; ?>> Admin Table </option>
                </select>
        	</form>
    		<p> Number of record(s) in <?php echo $table ?>: <?php echo $records; ?></p>
    	</div> 
   		<table>
			<tr>
				<?php
				    if ($table == 'user_table') {
    				    echo "
    				    <th align = 'left'><b> Edit </b></th>
    				    <th align = 'left'><b> Delete </b></th>";
				    }
				?>
				<th align = "left"><b><a href = "HopePlateAdminPanel.php?sort=id&table=<?php echo $table; ?>"> <?php echo ($table == 'admin_table') ? 
	            'Admin ID ' : 'User ID' ?> </a> </b> </th>
				<th align = "left"><b><a href = "HopePlateAdminPanel.php?sort=n&table=<?php echo $table; ?>"> Name </a> </b> </th>
				<th align = "left"><b><a href = "HopePlateAdminPanel.php?sort=e&table=<?php echo $table; ?>"> Email </a> </b> </th>
				<th align = "left"><b><a href = "HopePlateAdminPanel.php?sort=cn&table=<?php echo $table; ?>"> Contact number </a> </b> </th>
				<th align = "left"><b><a href = "HopePlateAdminPanel.php?sort=g&table=<?php echo $table; ?>"> Gender </a> </b> </th>
				<th align = "left"><b><a href = "HopePlateAdminPanel.php?sort=dob&table=<?php echo $table; ?>"> DOB </a> </b> </th>
				<th align = "left"><b><a href = "HopePlateAdminPanel.php?sort=dr&table=<?php echo $table; ?>"> Date Registered </a> </b> </th>
			</tr>
			
			<?php 
			     // Fetch and print all the records....
			     $background = '#FBB881';
			     while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			         $background = ($background == '#FBB881' ? '#DE7E5D' : '#FBB881');
			         echo '<tr style = "background-color:  '. $background .' ">'; 
			         if ($table == 'user_table'){
                	     echo '<td align = "left"> <a href="AdminPanelEdit.php? id=' . $row['user_id'] . '"> Edit </a></td>';
                	     echo '<td align = "left"> <a href="AdminPanelDelete.php? id=' . $row['user_id'] . '"> Delete </a></td>';
			         }
			         
                	 echo '<td align = "left">' . $row[$id] . '</td>';
                	 echo '<td align = "left">' . $row['name'] . '</td>';
                	 echo '<td align = "left">' . $row['email'] . '</td>';
                     echo '<td align = "left">' . $row['phone_num'] . '</td>';
                	 echo '<td align = "left">' . $row['gender'] . '</td>';
                	 echo '<td align = "left">' . $row['dob'] . '</td>';
                     echo '<td align = "left">' . $row['dr'] . '</td>';
                     echo '</tr>';
			     } // End of WHILE loop
			?>
		</table>
		<?php 
		      mysqli_free_result ($result);
		      mysqli_close($conn);
		      
		      // Make the links to other pages, if necessary.
		      if ($pages > 1) { 
		          echo '<p>';
		          $current_page = ($start / $display) + 1;
		          
		          // If it's not the first page, make a Previous button:
		          if ($current_page != 1) {
		              echo '<a href = "HopePlateAdminPanel.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"> Previous</a> ';
		          }
		          
		          // Make all the numbered pages:
		          for ($i = 1; $i <= $pages; $i++) {
		              if ($i != $current_page) {
		                  echo '<a href = "HopePlateAdminPanel.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		              } 
		              else {
		                  echo $i . ' ';
		              }
		          } // End of FOR loop.
		          
		          // If it's not the last page, make a Next button:
		          if ($current_page != $pages) {
		              echo '<a href = "HopePlateAdminPanel.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
		          }
		          
		          echo '</p>'; // Close the paragraph.  
		      } // End of links section.
		      
		?>
    </div>