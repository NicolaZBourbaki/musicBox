<?php 
include("includes/includedFiles.php");

$userId = $userLoggedIn->getUserId();
?>

<h1 class="pageHeadingBig">Альбоми, які ви додали</h1>

<div class="gridViewContainer">
    
    <?php   

		$query = mysqli_query($con, "SELECT albumId FROM AddedAlbums WHERE userId='$userId'");

		$array = array();

		while($row = mysqli_fetch_array($query)) {
			array_push($array, $row['albumId']);
		}
        
        $albumIdArray = $array;
        
		$i = 1;
		foreach($albumIdArray as $albumId) {

            $albumsQuery = mysqli_query($con, "SELECT * FROM albums WHERE id = '$albumId'");
            $row = mysqli_fetch_array($albumsQuery);
            $albumAuthor = $row['artist'];
            $artistsQuery = mysqli_query($con, "SELECT * FROM artists WHERE id = '$albumAuthor'");
            $artist = mysqli_fetch_array($artistsQuery);
			$album = new Album($con, $albumId);

            echo "<div class='gridViewItemAlbums'>
						<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
						<img src='musicBoxADMIN/artworkAlbum/" . $row['artworkPath'] . "'>

						<div class='gridViewInfo'>"
							. $row['title'] .
						"</div>
						
						<div class='gridViewInfoArtist'>"
							. $artist['name'] . 
						"</div>

					</span>

				</div>";	

			$i = $i + 1;
        }
        
?>
</div>