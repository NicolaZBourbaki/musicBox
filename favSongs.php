<?php 
include("includes/includedFiles.php");

$userId = $userLoggedIn->getUserId();;
?>

<h1 class="pageHeadingBig">Пісні, що вам сподобались</h1>

<div class="tracklistContainer">

    <button class="button songBT" onclick="playFirstSong()">СЛУХАТИ</button>

</div>

<div class="gridViewContainer">
    
    <div class="tracklistContainer">
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

                $query = mysqli_query($con, "SELECT songId FROM likedSongs WHERE userId='$userId'");
                $array = array();

                while($row = mysqli_fetch_array($query)) {
                    array_push($array, $row['songId']);
                }
                
                $songIdArray = $array;

		        $i = 1;
		        foreach($songIdArray as $songId) {

                    $songsQuery = mysqli_query($con, "SELECT * FROM songs WHERE id = '$songId'");
                    $row = mysqli_fetch_array($songsQuery);
                    $songAuthor = $row['artist'];
                    $songAlbum = $row['album'];
                    $artistsQuery = mysqli_query($con, "SELECT * FROM artists WHERE id = '$songAuthor'");
                    $artist = mysqli_fetch_array($artistsQuery);
			        $AddedSong = new Song($con, $songId);
                    $thisSongId = $AddedSong->getId();

			          echo "<li class='tracklistRow'>
				    	    <div class='trackCount'>
					    	    <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $AddedSong->getId() . "\", tempPlaylist, true)'>
                
						        <span class='songLike'><img src='assets/images/icons/likeWhite.png' onclick='likeSong($thisSongId)'><span>
						        <span class='trackNumber'>$i</span>
				        	</div>


				        	<div class='trackInfo'>
					        	<span class='trackName' title = '". $AddedSong->getPlaysNumber() ." прослуховувань'>" . $AddedSong->getTitle() . "</span>
                                <span class='artistName'>" . $artist['name'] . "</span>
					       </div>

				        	<div class='trackOptions'>
					    	    <input type='hidden' class='songId' value='" . $AddedSong->getId() . "'>
						        <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
				        	</div>

					       <div class='trackDuration'>
						        <span class='duration'>" . $AddedSong->getDuration() . "</span>
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
    
</div>