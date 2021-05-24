<?php
include("includes/includedFiles.php");

if(isset($_GET['id'])) {
	$artistId = $_GET['id'];
}
else {
	header("Location: index.php");
}

	$artist = new Artist($con, $artistId);
	
	$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist = '$artistId' ORDER BY year DESC");
	$thisAlbum = mysqli_fetch_array($albumQuery);
	$albumId = $thisAlbum['id'];
	
?>

	<div class="entityInfo">

	<div class="leftSection">

		<img src="/artworkArtist/<?php echo $artist->getArtistPic();?>">
		
	</div>


	<input type="hidden" class="artistId" name="artistId" value="<?php echo $artist->getId(); ?>"  placeholder="Id артиста" />
	
	<?php 

		$artistId = $artist->getId();
		echo "<button class='followButton' onclick='deleteArtist($artistId)'>Видалити артиста</button>";

	?>
		

	<div class="centerSection">

		<div class="artistInfo">

			<h1 class="artistPageName"><?php echo $artist->getName(); ?></h1>

			<div class="description">

				<p class="decscriptionText"><?php echo $artist->getDescription(); ?></p>

			<div>
			
		</div>
	
	</div>

</div><br /><br /><br />

<div class="tracklistContainer borderBottom">

	<h2>Найпопулярніші релізи<br/><br/>
		
		<button class="button yellow" onclick="playFirstSong(); ">СЛУХАТИ</button>

 	</h2>

	 <li class='tracklistRowFirst'>
			<div class='trackCount'>
				<span class='play'></span>
				<span class='trackNumber'>#</span>
			</div>


			<div class='trackInfo'>
				<span class='trackNameFirst'>Назва пісні</span>
				<span class='artistName'></span>
			</div>

			<div class='trackOptions'>
				<img class='optionsButton' src='assets/images/icons/more.png' >
				<img class='optionsButton' src='assets/images/icons/like.png' >
			</div>

			<div class='trackDurationArtist'  title = 'Тривалість пісні'>
				<img src='assets/images/icons/clock.png'>
			</div>

			<div class='trackPlaysNumber' title = 'Кількість прослуховувань'>
				<img src='assets/images/icons/PlaysNumber.png'>
			</div>


		</li>

	<ul class="tracklist">
		
		<?php
		$songIdArray = $artist->getSongIds();

		$i = 1;
		foreach($songIdArray as $songId) {

			if($i > 5) {
				break;
			}

			$albumSong = new Song($con, $songId);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName' >" . $albumSong->getTitle() . "</span>
						<span class='artistName'>" . $albumArtist->getName() . "</span>
					</div>

					<div class='trackOptions'>
						<input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
					</div>

					<div class='trackDurationArtist'>
						<span class='duration'>" . $albumSong->getDuration() . "</span>
					</div>

					<div class='trackPlaysNumber'>
						<img class='Number' src='assets/images/icons/Number.png' title = '". $albumSong->getPlaysNumber() . " прослуховувань'>
					</div>


				</li>";

			$i = $i + 1;
		}

		?>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>

	</ul>
</div>

<div class="gridViewContainer">
	<h2>Альбоми та сингли</h2>
	<?php

	$albumIdArray = $artist->getAlbumIds();

	$a = 1;
	foreach($albumIdArray as $albumId) {
			$ThisAlbum = new Album($con, $albumId);

			if($a == 1){
			echo "<div class='gridViewItem'>
				<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $ThisAlbum->getId() . "\")'>
					<img src='/artworkAlbum/" . $ThisAlbum->getArtworkPath() . "'>

					<div class='gridViewInfo'>"
						. $ThisAlbum->getTitle() .
					"</div>
				
					<div class='gridViewInfoAlbum'>Найновіший реліз</div>

				</span>

			</div>";	
			} else{
			echo "<div class='gridViewItem'>
				<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $ThisAlbum->getId() . "\")'>
					<img src='/artworkAlbum/" . $ThisAlbum->getArtworkPath() . "'>

					<div class='gridViewInfo'>"
						. $ThisAlbum->getTitle() .
					"</div>
				
					<div class='gridViewInfoAlbum'>" . $ThisAlbum->getType() . " • " . $ThisAlbum->getYear() . "</div>

				</span>

			</div>";
		}
		$a = $a + 1;
	}
	?>

</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>