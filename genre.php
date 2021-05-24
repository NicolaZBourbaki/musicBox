<?php 
include("includes/includedFiles.php");
?>

<h1 class="pageHeadingBig"></h1>

<div class="gridViewContainer">

	<?php

    if(isset($_GET['id'])) {
        $genreId = $_GET['id'];
	}
	
		$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE genre = '$genreId' ");

		while($row = mysqli_fetch_array($albumQuery)) {
			



			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
						<img src='musicBoxADMIN/artworkAlbum/" . $row['artworkPath'] . "'>

						<div class='gridViewInfo'>"
							. $row['title'] .
						"</div>
					</span>

				</div>";



		}
	?>

</div>