<?php 
include("includes/includedFiles.php");
?>

<h1 class="pageHeadingBig">Виберіть жанр, який вам до смаку</h1>

<div class="gridViewContainer">

	<?php
		$genresQuery = mysqli_query($con, "SELECT * FROM genres ");

		while($row = mysqli_fetch_array($genresQuery)) {
			



			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"genre.php?id=" . $row['id'] . "\")'>
						<img src='" . $row['genrePic'] . "'>

						<div class='gridViewInfo'>"
							. $row['name'] .
						"</div>
					</span>

				</div>";



		}
	?>

</div>