<div class="belize-hole">
        <p style="display:inline;">
        <img src="img/artists/<?php print $artist->getPicture(); ?>" width="300px" style="margin-right:20px;">
        </p>
        <h1 style="display:inline-block; vertical-align:middle">
                <?php print $artist; ?><br>
                <small class="text-clouds">
                                <?php 
                $raterCount = $artist->countRaters();
                if ($raterCount > 0)
                {
                        print 'Average: ' . (float)$artist->getAverage() . ' / 10 (' . $raterCount . ' rater';
                        if ($raterCount > 1) 
                        {
                                print 's';
                        }
                        print ')';
                }

                ?>      
                </small>
        </h1>
        <div class="btn-group btn-group-lg pull-right">
                <button class="btn btn-success" type="button" title="Right informations">
                         <span class="glyphicon glyphicon-thumbs-up"> 0 </span>
                </button>
                <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown" type="button" title="Wrong informations">
                         <span class="glyphicon glyphicon-thumbs-down"> 0 </span>
                         <span class="caret"></span>
                </button>        
                <ul class="dropdown-menu" role="menu">
                 <li><a href="#">Incomplete</a></li>
                 <li><a href="#">Not genuine</a></li>
                 <li><a href="#">Unfounded</a></li>
                 <li><a href="#">Spelling mistake</a></li>
                 <li><a href="#">Rumour</a></li>
                 <li><a href="#">Duplicated Data</a></li>
                </ul>
        </div>
</div>