<?php 
include("includes/includedFiles.php");

$userId = $userLoggedIn->getUserId();
?>

<h1 class="pageHeadingBig">Артисти на яких ви підписані</h1>

<div class="gridViewContainer">
    
    <?php   

		$query = mysqli_query($con, "SELECT artistId FROM follows WHERE userId='$userId'");

		$array = array();

		while($row = mysqli_fetch_array($query)) {
			array_push($array, $row['artistId']);
		}
        
        $artistIdArray = $array;
        
		$i = 1;
		foreach($artistIdArray as $artistId) {

            $artistsQuery = mysqli_query($con, "SELECT * FROM artists WHERE id = '$artistId'");
            $row = mysqli_fetch_array($artistsQuery);
			$artist = new Artist($con, $artistId);

            echo "<div class='border'>
            <div onclick='openPage(\"artist.php?id=" . $row['id'] . "\")' class='gridViewInfoFollows'>"
                . $row['name'] .
            "</div>

            <div class='gridViewItemFollows'>
                
                    <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $row['id'] . "\")'>

                        <img src='musicBoxADMIN/artworkArtist/" . $row['artistPic'] . "'>
                        
                        <div class='artistInfoFollows' onclick='openPage(\"artist.php?id=" . $row['id'] . "\") align = 'center'><h2>" . $row['name'] . "</h2><p align='center'>" . $row['description'] . "</p></div>

					</span>

                </div>
            </div>";	

			$i = $i + 1;
        }
        
?>
</div>