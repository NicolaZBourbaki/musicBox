<?php include("includes/includedFiles.php"); 

if(isset($_GET['id'])) {
	$albumId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();
$artistId = $artist->getId();
?>

<div class="entityInfoAlbum">

	<div class="leftSectionAlbum">
		<img src="musicBoxADMIN/artworkAlbum/<?php echo $album->getArtworkPath();?>">
	</div>

	<div class="rightSection">
	
		<span class = "AlbumType">

			<?php echo $album->getType(); ?>

		</span><br />

		<span class = "AlbumName"><?php echo $album->getTitle(); ?></span><br />

		<p class="AlbumText">Виконавець: <span class = "AlbumAuthor" onclick="openPage('artist.php?id=<?php echo $artistId; ?>')"><?php echo $artist->getName();?></span></p>

		<span class="AlbumInfo"><?php echo $album->getYear(); echo " рік • "; $songNum = $album->getNumberOfSongs(); if($songNum == 1){ echo $songNum; echo " Пісня";} if($songNum == 2 || $songNum == 3 || $songNum == 4){ echo $songNum; echo " Пісні";} if($songNum == 5 || $songNum == 6 || $songNum == 7 || $songNum == 8 || $songNum == 9 || $songNum == 10 || $songNum == 11 || $songNum == 12 || $songNum == 13|| $songNum == 14 || $songNum == 15){ echo $songNum; echo " Пісень";} ?></span><br />

		<br /><br /><br /><button class="button albumBT" onclick="playFirstSong()">СЛУХАТИ</button>
		<input type="hidden" class="albumId" name="albumId" value="<?php echo $albumId ?>"  placeholder="Id альбома" />
		<span class='albumButtonAdd' onclick="addAlbum('albumId')">
		<?php 
			
			$userName = $userLoggedIn->getUsername();
			$UsersQuery = mysqli_query($con, "SELECT * FROM users WHERE username = '$userName'");
			$userAr = mysqli_fetch_array($UsersQuery);
			$user = $userId = $userLoggedIn->getUserId();
			$AddAlbumCheck = mysqli_query($con, "SELECT * FROM AddedAlbums WHERE userId = '$user' AND albumId = '$albumId' ");
			if(mysqli_num_rows($AddAlbumCheck) == 1) {
				echo "<img class='deleteImg' title='Видалити з медіатеки' src='assets\images\icons\deleteWhite.png'>";
			}
			else echo "<img title='Додати в медіатеку' src='assets\images\icons\plusWhite.png'>"; 
		
		?></span>

	</div>

</div>


<div class="tracklistContainer borderBottom">
	<ul class="tracklist">
		
		<li class='tracklistRowFirst'>
			<div class='trackCount'>
				<span class='play'></span>
				<span class='trackNumber'>#</span>
			</div>


			<div class='trackInfo'>
				<span class='trackNameFirst' title = "">Назва пісні</span>
				<span class='artistName'></span>
			</div>

			<div class='trackOptions'>
				<img class='optionsButton' src='assets/images/icons/more.png' >
				<img class='optionsButton' src='assets/images/icons/like.png' >
			</div>

			<div class='trackDuration'>
				<img src='assets/images/icons/clock.png'>
			</div>


		</li><br />

		<?php

		$songIdArray = $album->getSongIds();
		$i = 1;
		foreach($songIdArray as $songId) {
			$albumSong = new Song($con, $songId);
			$albumArtist = $albumSong->getArtist();
			$thisSongId = $albumSong->getId();
			
			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
						
						<span class='songLike'><img src='assets/images/icons/likeWhite.png' onclick='likeSong($thisSongId)'></span>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName' title = '". $albumSong->getPlaysNumber() ." прослуховувань'>" . $albumSong->getTitle() . "</span>
						
					</div>

					<div class='trackOptions'>
						<input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
						<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
					</div>

					<div class='trackDuration'>
						<span class='duration'>" . $albumSong->getDuration() . "</span>
					</div>


				</li>";

			$i = $i + 1;
		}

		?>
	
</div>
<div class="gridViewContainer">
<?php
	
	$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist = '$artistId' ORDER BY year DESC");
	
	if(mysqli_num_rows($albumQuery) > 1) {
		echo "<h2>Інші релізи від: <span class = 'ArtistHover' onclick='openPage(\"artist.php?id=" . $artistId . "\")'>" . $artist->getName() . "</span></h2>";
	}
	
		$a = 1;
		while($row = mysqli_fetch_array($albumQuery)) {
			if($row['title'] != $album->getTitle()){
				echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
						<img src='musicBoxADMIN/artworkAlbum/" . $row['artworkPath'] . "'>

						<div class='gridViewInfo'>"
							. $row['title'] .
						"</div>
						
						<div class='gridViewInfoAlbum'>" . $row['year'] . "</div>

					</span>

				</div>";	
			}
			$a = $a + 1;
		}
	?>

<div>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>

	</ul>
</div>


<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>







