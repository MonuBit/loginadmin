<?php
$msg  = "";
		if(isset($_POST['upload']))
		{
			$target = "images/".basename($_FILES['image']['name']);
			
			
			$db = mysqli_connect("localhost","root","root","photos");
			
			$image = $_FILES['image']['name'];
			$text = $_POST['text'];
			
			$sql = "INSERT INTO images (image,text) VALUES ('$image', '$text')";
			mysqli_query($db,$sql);
			
			if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
				$msg = "Image upload successfully";
			}
			
			else {
				$msg = "There was a error";
			}
			
		}
?>





<!DOCTYPE html>

<html>
<head>
	<title>Image Upload</title>
	<link rel = "stylesheet" type = "text/css" href = "style.css">
	
</head>

	<body>
		<div id = "content">
		
		<?php
		$db = mysqli_connect("localhost","root","root","photos");
		$sql = "SELECT * FROM images";
		$result = mysqli_query($db,$sql);
		while($row  = mysqli_fetch_array($result)){
			echo "<div id = 'img_div>'";
			echo "<img src = 'images/".$row['image']."'>";
			echo "<p>".$row['text']."</p>";
			echo "</div>";
		}
		?>
		<form method = "post" action = "index.php" enctype = "multipart/form-data">
		<input type = "hidden" name = "size" value = "1000000">
		<div>
		<input type = "file" name = "image">
		</div>
		<div>
		<textarea name = "text" cols = "40"rows = "4" placeholder = "information about this image"></textarea>
		</div>
		
		<div>
		<input type = "submit"	name = "upload" value = "Upload image">
		</div>
		</form>
		</div>
	</body>
</html>