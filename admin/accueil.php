<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<title>Musiclib - Administration</title>
	<link rel="stylesheet" href="design.css" media="screen" />
	<script type="text/javascript" src="administration.js"></script>    
</head>

<body>

	<noscript><br/><br/><br/><br/><br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Javascript est indispensable à l'utilisation de ce site, merci de l'activer dans les préférences de votre navigateur</noscript>

	<header>
    	<div id="header_top"><h1 onClick="add_nav(1)">MusicLib - Admin</h1></div>
        <div id="header_bottom">
       		<div id="elem_header1" onClick="add_nav(1)">Stats</div>
           	<div id="elem_header2" onClick="add_nav(2)">Last Actions</div>
           	<div id="elem_header3" onClick="add_nav(3)">Messages</div>
           	<div id="elem_header4" onClick="add_nav(4)">Database</div>
       	</div>
    </header>
    
    <div id="get_nav"></div>
    
    <div id="workspace">
    	<!--<div id="cerc_a_venir"><div class="bordure"><div class="cercle"><div class="icone"><img src="icone.png"/></div><div class="val">5361</div></div></div></div>-->
    </div>
    
    <script type="text/javascript">
		add_nav(1);
	</script>
    
    

<!-- stats : nb album, artistes, songs, user, commentaires, notes, écoutes, artistes authentifiés, album authentifés
-->
</body>
</html>