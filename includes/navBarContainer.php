<div id="navBarContainer">
	<nav class="navBar">
	<meta charset="UTF-8">
		<span role="link" tabindex="0" onclick="openPage('index.php')" class="logo">
			<img src="assets/images/icons/logo.png">
		</span>


		<div class="group">

			<div class="navItem">
				<span role='link' tabindex='0' onclick='openPage("search.php")' class="navItemLink">
					Пошук
					<img src="assets/images/icons/search.png" class="icon" onclick="openPage('search.php')" alt="Search">
				</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('browse.php')" class="navItemLink">Огляд</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('genresBrowse.php')" class="navItemLink">Жанри</span>
			</div>

		</div>

		<div class="group">

		<div class="scroll">
			<div class="navType">
				<span tabindex="0" class="navItemType">МОЯ МЕДІАТЕКА</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('favSongs.php')" class="navItemLink">Улюблені пісні</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('follows.php')" class="navItemLink">Виконавці</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('favAlbums.php')" class="navItemLink">Альбоми</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('settings.php')" class="navItemLink">Налаштування</span>
			</div>


			<div class="navType">
				<span tabindex="0" class="navItemType">ПЛЕЙЛИСТИ</span>
			</div>
			
			
			<?php
			$username = $userLoggedIn->getUsername();

			$playlistsQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$username'");

			if( $playlistsQuery != true) {
				echo "<div class='navItem'>
						<span class='noPlaylistYet'>Ви поки не створили жодного плейлиста</span>
					</div>";
			}

			if( $playlistsQuery == true) {
			while($row = mysqli_fetch_array($playlistsQuery)) {

				$playlist = new Playlist($con, $row);

				echo "<div class='navItem'>
						<span role='link' tabindex='0' onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")' class='navItemLink'>" . $playlist->getName() . "</span>
					</div>";

			}
		}
		?>
		</div>
		
		</div>

		<div class="group">
			
			<div class="opacity">

				<img src="assets/images/icons/addWhite.png" class="addIcon" alt="add">

				<div class="navItemAdd">
				
					<span role="link" tabindex="0" onclick="createPlaylist()" id="add"  class="navItemLinkAdd">Новий плейлист</span>

				</div>
			<div>
		</div>
	</nav>
</div>