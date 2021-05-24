<?php 
include("includes/includedFiles.php");
?>

<h1 class="pageHeadingBig">Улюблене</h1>

<div class="gridViewConeiner">

            <div class = "gridViewItem">

                    <span role="link" tabindex="0" onclick= "openPage('follows.php')">
            
				    <img src = "assets\images\icons\artists.jpg">

				    <div class = "gridViewInfo">Улюблені артисти</div>
                        
                </span>
            
            </div>

            <div class = "gridViewItem">

                    <span role="link" tabindex="0" onclick= "openPage('favAlbums.php')">
            
				    <img src = "assets\images\icons\albums.jpg">

				    <div class = "gridViewInfo">Улюблені альбоми</div>
                        
                </span>
            
            </div>
            
            <div class = "gridViewItem">

                    <span role="link" tabindex="0" onclick= "openPage('favSongs.php')">
            
				    <img src = "assets\images\icons\songs.jpg">

				    <div class = "gridViewInfo">Улюблені пісні</div>
                        
                </span>
            
            </div>
	
</div>