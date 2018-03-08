<?php
 # if(isset($_POST['submit'])){
  if(isset($_GET['name'])){
  $name=$_GET['name'];
  //connect  to the database
  $db=mysql_connect  ("localhost", "root",  "") or die ('I cannot connect to the database  because: ' . mysql_error());
  //-select  the database to use
  $mydb=mysql_select_db("chatchat");
  //-query  the database table
  $sql="SELECT ID, Firstname, Lastname FROM customers WHERE Firstname = '$name'";
  //-run  the query against the mysql query function
  $result=mysql_query($sql);
  //-create  while loop and loop through result set
  while($row=mysql_fetch_array($result)){
          $FirstName=$row['Firstname'];
          $LastName=$row['Lastname'];
          $ID=$row['ID'];
  //-display the result of the array
  echo "<ul>\n";
  echo "$ID   $FirstName  $LastName";
#  echo "<li>" . "<a href=\"search.php?id=$ID\">"   .$FirstName . " " . $LastName .  "</a></li>\n";
  echo "</ul>";
  }
  }
  else{
  echo  "<p>Please enter a search query</p>";
  }
#  }
?>
