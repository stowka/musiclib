<div class="carrot">
<div class="container">
	<table class="table">
		<thead>
            <tr>
                <th>
                    Track
                </th>
                <th>
                    Title
                </th>
               <!--  <th  class="text-right">
                    Duration
                </th>
                <th  class="text-center">
                    Rate
                </th> -->
                <th class="text-right">
                    Average
                </th>
            </tr>
        </thead>
        <tbody>
		<?php
			foreach ( $album->getSongs() as $song ):
		?>
	        <tr>
	            <td>
					<?php print new IncludedIn($song->getId(), $album->getId()) ;?>
	            </td>
	            <td>
	            	<a href="<?php print $song->getUrl(); ?>" ><?php print $song; ?></a>
	            </td>
	            <!-- <td  class="text-right">
	            	<?php #print $song-getDuration(); ?>
	            </td>
				<td  class="text-center">
	                <div class="slider slider-horizontal" id="rate" style="cursor:pointer; width:90%;"></div>
					<span id="rateUser" class="padded"> Rate it now!</span>
								
	            </td> -->
				<td class="text-right">
				<?php
					if ($song->countRaters() > 0)
					{
						print (float)$album->getAverage() . ' / 10';
					}
					else{
						print '- / 10';
					}
				?>
	            </td>
	        </tr>
        <?php
            endforeach;
        ?>
            </tbody>
	<table>
</div>
</div>