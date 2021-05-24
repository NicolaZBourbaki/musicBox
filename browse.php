<?php 
include("includes/includedFiles.php");
?>

<div class="userPart">

	<div class="userName" onclick="openPage('updateDetails.php')">
		<?php echo $userLoggedIn->getFirstAndLastName(); ?>
	</div>

	<img src="<?php echo $userLoggedIn->getUserPic(); ?>" onclick="openPage('updateDetails.php')">

</div>
<h1 class="pageHeadingBig">Вам може сподобатись</h1>

<div class="gridViewContainer">
	<h2>Альбоми</h2>
	<div class="gridViewRow">
	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 15");
		
		while($row = mysqli_fetch_array($albumQuery)) {
			
			$artistId = $row['artist'];

			$artist = new Artist($con, $artistId);

			echo "<div class='gridViewItemBrowse'>
					<span role='link' >
						<img  title='". $row['title'] ."' src='musicBoxADMIN/artworkAlbum/" . $row['artworkPath'] . "' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>

						<div class='gridViewInfo' onclick='openPage(\"album.php?id=" . $row['id'] . "\")' >"
							. $row['title'] .
						"</div>

						<div class='gridViewInfoArtist' onclick='openPage(\"artist.php?id=" . $row['artist'] . "\")'>"
							. $artist->getName() .
						"</div>

					</span>

				</div>";



		}
	?>

</div>
</div>

<div class="gridViewContainer">
	<h2>Артисти</h2>
	<div class="gridViewRow">
	<?php
		$artistsQuery = mysqli_query($con, "SELECT * FROM artists ORDER BY RAND() LIMIT 15");
		
		while($row = mysqli_fetch_array($artistsQuery)) {

			echo "<div class='gridViewItemBrowseArtist'>
					<span role='link' >
						<img  title='". $row['name'] ."' src='musicBoxADMIN/artworkArtist/" . $row['artistPic'] . "' onclick='openPage(\"artist.php?id=" . $row['id'] . "\")'>

						<div class='gridViewInfoArtistBrowse' onclick='openPage(\"artist.php?id=" . $row['id'] . "\")'>"
							. $row['name'] .
						"</div>

					</span>

				</div>";



		}
	?>

</div>
</div>