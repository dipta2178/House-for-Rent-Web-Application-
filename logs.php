<?php

require_once "config.php";
$con=mysqli_connect("localhost:3308","root","","house4rent");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
$result = mysqli_query($con, "SELECT * FROM comments ORDER BY id ASC");
while($row=mysqli_fetch_array($result)){
echo "<div class='comments_content'>";
echo "<h4><a href='delete.php?id=" . $row['id'] . "'> X</a></h4>";
echo "<h4>" . $row['name'] . "</h4>";
echo "<h4>" . $row['date_publish'] . "</h4></br></br>";
echo "<h4>" . $row['comments'] . "</h4>";
echo "</div>";
}
mysqli_close($con);

?>