<?php
	class Artist {

		private $con;
		private $id;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}
		
		public function getName() {
			
			$artistQuery = mysqli_query($this->con, "SELECT name FROM artists WHERE id='$this->id'");
			$artist = mysqli_fetch_array($artistQuery);
			return $artist['name'];
		}
		
		public function getArtistPic() {
			$artistQuery = mysqli_query($this->con, "SELECT artistPic FROM artists WHERE id='$this->id'");
			$artist = mysqli_fetch_array($artistQuery);
			return $artist['artistPic'];
		}

		public function getDescription(){
			$artistQuery = mysqli_query($this->con, "SELECT description FROM artists WHERE id='$this->id'");
			$artist = mysqli_fetch_array($artistQuery);
			return $artist['description'];
		}

		public function getSongIds() {

			$query = mysqli_query($this->con, "SELECT id FROM songs WHERE artist='$this->id' ORDER BY plays DESC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['id']);
			}

			return $array;
		}

		public function getAlbumIds() {

			$query = mysqli_query($this->con, "SELECT id FROM albums WHERE artist='$this->id' ORDER BY year DESC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['id']);
			}

			return $array;
		}

	}
?>