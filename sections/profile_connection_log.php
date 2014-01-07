<div class="asbestos">
	<table class="table">
		<caption>Last connections</caption>
		<thead>
			<tr>
				<th>
					Date
				</th>
				<th>
					IP Address
				</th>
				<th>
					Operating System
				</th>
				<th>
					Browser
				</th>
			</tr>
		</thead>

		<tbody>
			<?php
				foreach( $user->getConnectionLog( 3 ) as $connection ):
			?>
					<tr>
						<td>
							<?php
								print $connection->getDate()->format( "jS F Y - H:i:s" );
							?>
						</td>

						<td>
							<?php
								print $connection;
							?>
						</td>

						<td>
							<?php
								print $connection->getOs();
							?>
						</td>

						<td class="text-center">
							<?php
								print '<img width="30px" alt="Browser" src="img/logos/';
								switch(  $connection->getBrowser() ):
									case "Mozilla Firefox":
										print 'firefox.png';
										break;
									case "Google Chrome":
										print 'chrome.png';
										break;
									case "Apple Safari":
										print 'safari.png';
										break;
									case "Internet Explorer":
										print 'ie.png';
										break;
									case "Opera":
										print 'opera.png';
										break;
									case "Other":
										print 'ie.png';
										break;
								endswitch;
								print '">';
							?>
						</td>
					</tr>
			<?php
				endforeach;
			?>
		</tbody>
	</table>
</div>