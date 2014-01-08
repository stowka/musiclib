function add_nav(el) {
	switch(el)
	{
		case 1 :
			document.getElementById("elem_header1").style.backgroundColor="#6f6f6f";
			document.getElementById("elem_header2").style.backgroundColor="";
			document.getElementById("elem_header3").style.backgroundColor="";
			document.getElementById("elem_header4").style.backgroundColor="";
			document.getElementById("get_nav").innerHTML = ""
			document.getElementById("workspace").style.marginLeft = "auto";
			document.getElementById("workspace").style.marginRight = "auto";
			document.getElementById("workspace").style.maxWidth = "800px";		
			var stats = completeStats();
			document.getElementById("workspace").innerHTML = '<h1>Stats</h1><div id="stats_info"><div class="bordure"><div class="cercle"><div class="icone"><img src="star.png"/></div><div class="val">' + stats[0]
														   + '</div></div></div><h2>Artists</h2></div><div id="stats_info"><div class="bordure"><div class="cercle"><div class="icone"><img src="album.png"/></div><div class="val">' + stats[1] 
														   + '</div></div></div><h2>Albums</h2></div><div id="stats_info"><div class="bordure"><div class="cercle"><div class="icone"><img src="song.png"/></div><div class="val">' + stats[2] 
														   + '</div></div></div><h2>Songs</h2></div><div id="stats_info"><div class="bordure"><div class="cercle"><div class="icone"><img src="notarize.png"/></div><div class="val">' + stats[7] 
														   + '</div></div></div><h2>Notarizations</h2></div><div id="stats_info"><div class="bordure"><div class="cercle"><div class="icone"><img src="icone.png"/></div><div class="val">' + stats[3] 
														   + '</div></div></div><h2>Users</h2></div><div id="stats_info"><div class="bordure"><div class="cercle"><div class="icone"><img src="known.png"/></div><div class="val">' + stats[4] 
														   + '</div></div></div><h2>Known Songs</h2></div><div id="stats_info"><div class="bordure"><div class="cercle"><div class="icone"><img src="grade.png"/></div><div class="val">' + stats[5] 
														   + '</div></div></div><h2>Grades</h2></div><div id="stats_info"><div class="bordure"><div class="cercle"><div class="icone"><img src="comment.png"/></div><div class="val">' + stats[6] 
														   + '</div></div></div><h2>Comments</h2></div>';
			break;
		case 2 :
			document.getElementById("elem_header1").style.backgroundColor="";
			document.getElementById("elem_header2").style.backgroundColor="#6f6f6f";
			document.getElementById("elem_header3").style.backgroundColor="";
			document.getElementById("elem_header4").style.backgroundColor="";
			document.getElementById("get_nav").innerHTML = "<nav><h1 onClick='last_actions_show(1.0)'>Last Actions</h1><h2 onClick='last_actions_show(1.1)'>Album Notarizations</h2><h2 onClick='last_actions_show(1.2)'>Artist Notarizations</h2><h2 onClick='last_actions_show(1.3)'>Albums Creations</h2><h2 onClick='last_actions_show(1.4)'>Artists Creations</h2><h2  onClick='last_actions_show(1.5)'>New Users</h2><h2 onClick='last_actions_show(1.6)'>Connections</h2><h1 onClick='last_actions_show(2.0)'>Most Repeted Actions</h1></nav>";
			document.getElementById("workspace").innerHTML = '';
			break;
		case 3 :
			document.getElementById("elem_header1").style.backgroundColor="";
			document.getElementById("elem_header2").style.backgroundColor="";
			document.getElementById("elem_header3").style.backgroundColor="#6f6f6f";
			document.getElementById("elem_header4").style.backgroundColor="";
			document.getElementById("get_nav").innerHTML = "<nav><h1 onClick='messages_show(1.0)'>Mailbox</h1><h2 onClick='messages_show(1.1)'>All</h2><h2 onClick='messages_show(1.2)'>Unread mails</h2><h2 onClick='messages_show(1.3)'>Archives</h2></nav>";
			document.getElementById("workspace").innerHTML = '';
			break;
		case 4 :
			document.getElementById("elem_header1").style.backgroundColor="";
			document.getElementById("elem_header2").style.backgroundColor="";
			document.getElementById("elem_header3").style.backgroundColor="";
			document.getElementById("elem_header4").style.backgroundColor="#6f6f6f";
			document.getElementById("get_nav").innerHTML = "<nav><h1 onClick='database_show(1.0)'>Knowledge</h1><h2 onClick='database_show(1.1)'>Artists</h2><h2 onClick='database_show(1.2)'>Albums</h2><h2 onClick='database_show(1.3)'>Songs</h2><h2 onClick='database_show(1.4)'>Album Types</h2><h2 onClick='database_show(1.5)'>Genres</h2><h1 onClick='database_show(2.0)'>Users and Activities</h1><h2 onClick='database_show(2.1)'>Users</h2><h2 onClick='database_show(2.2)'>Known songs</h2><h2 onClick='database_show(2.3)'>Grades</h2><h2 onClick='database_show(2.4)'>Comments</h2><h2 onClick='database_show(2.5)'>Connections</h2><h1 onClick='database_show(3.0)'>Notarizations</h1><h2 onClick='database_show(3.1)'>Artists</h2><h2 onClick='database_show(3.2)'>Albums</h2></nav>";
			document.getElementById("workspace").innerHTML = '';
			break;
		default :
		document.getElementById("workspace").innerHTML = '';
		alert("erreur : option innexistante");
		break;
	}
}

function last_actions_show(el) {
	switch(el)
	{
		case 1.0 :
			document.getElementById("workspace").style.marginLeft="200px";
			document.getElementById("workspace").innerHTML = "";
			break;
			
			case 1.1 :
				document.getElementById("workspace").style.marginLeft="200px";
				notarizeAlbum();
				break;
			case 1.2 :
				document.getElementById("workspace").style.marginLeft="200px";
				notarizeArtist();
				break;
			case 1.3 :
				document.getElementById("workspace").style.marginLeft="200px";
				lastAlbum();
				break;
			case 1.4 :
				document.getElementById("workspace").style.marginLeft="200px";
				lastArtist();
				break;
			case 1.5 :
				document.getElementById("workspace").style.marginLeft="200px";
				lastUser();
				break;
			case 1.6 :
				document.getElementById("workspace").style.marginLeft="200px";
				lastConnection();				
				break;
				
				
		case 2.0 :
			document.getElementById("workspace").innerHTML = "";
			break;
			
			
		default :
			document.getElementById("workspace").style.marginLeft="0px";
			document.getElementById("workspace").innerHTML = "";
			break;
		
	}
}

function messages_show(el) {
	switch(el)
	{
		case 1.0 :
			document.getElementById("workspace").style.marginLeft="0px";
			document.getElementById("workspace").innerHTML = "";
			break;
			
			case 1.1 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
			case 1.2 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
			case 1.3 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
				
		default :
			document.getElementById("workspace").style.marginLeft="0px";
			document.getElementById("workspace").innerHTML = "";
			break;	
	}
}

function database_show(el) {
	switch(el)
	{
		case 1.0 :
			document.getElementById("workspace").style.marginLeft="200px";
			document.getElementById("workspace").innerHTML = "";
			break;
			
			case 1.1 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
			case 1.2 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
			case 1.3 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
			case 1.4 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
			case 1.5 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
				
		
		case 2.0 :
			document.getElementById("workspace").style.marginLeft="200px";
			document.getElementById("workspace").innerHTML = "";
			break;
			
			case 2.1 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
			case 2.2 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
			case 2.3 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
			case 2.4 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
			case 2.5 :
				document.getElementById("workspace").style.marginLeft="200px";
				document.getElementById("workspace").innerHTML = "";
				break;
				
				
		case 3.0 :
			document.getElementById("workspace").style.marginLeft="200px";
			document.getElementById("workspace").innerHTML = "";
			break;
			
			case 3.1 :
				document.getElementById("workspace").style.marginLeft="200px";
				notarizeArtistDB();
				break;
			case 3.2 :
				document.getElementById("workspace").style.marginLeft="200px";
				notarizeAlbumDB();
				break;
				
				
		default :
			document.getElementById("workspace").style.marginLeft="0px";
			document.getElementById("workspace").innerHTML = "";
			break;	
	}
}

function completeStats() {
	var data, stats;
	var xhr = new XMLHttpRequest();	 
	 
	xhr.onreadystatechange=function()
	{
	    if (xhr.readyState==4 && xhr.status==200)
	    {
	    	data=xhr.responseText;
	    	stats = data.split(',');
	    }
	}
	xhr.open("GET","stats.php",false);  
	xhr.send();
	return stats;
}

function notarizeAlbum() {
	var xhr = new XMLHttpRequest();	 
	 
	xhr.onreadystatechange=function()
	{
	    if (xhr.readyState==4 && xhr.status==200)
	    {
	    	data=xhr.responseText;
	    	al = data.split(';');
	    	var infos="";
	    	var html="<table><thead><th>Agreement</th><th>Cause</th><th>Album</th><th>Artist</th><th>User</th><th>More</th></thead>";
	    	for(var i=0;i<al.length-1;i++)
			{
				infos=al[i].split(",");
				html += '<tr><td>'+infos[0]+'</td><td>'+infos[1]+' </td><td>'+infos[2]+'</td><td>'+infos[3]+'</td><td>'+infos[4]
					 +'</td><td><a href="../album.php?id='+infos[5]+'" alt="Album page">+</a></td></tr>';

			}
			html += "</tbody></table";
			document.getElementById("workspace").innerHTML=html;
	    }
	}
	xhr.open("GET","lastaction.php?choice=1.1",true);  
	xhr.send();//lien à modifier
}

function notarizeAlbumDB() {
	var xhr = new XMLHttpRequest();	 
	 
	xhr.onreadystatechange=function()
	{
	    if (xhr.readyState==4 && xhr.status==200)
	    {
	    	data=xhr.responseText;
	    	al = data.split(';');
	    	var infos="";
	    	var html="<table><thead><th>Agreement</th><th>Cause</th><th>Album</th><th>Artist</th><th>User</th><th>More</th></thead>";
	    	for(var i=0;i<al.length-1;i++)
			{
				infos=al[i].split(",");
				html += '<tr><td>'+infos[0]+'</td><td>'+infos[1]+' </td><td>'+infos[2]+'</td><td>'+infos[3]+'</td><td>'+infos[4]
					 +'</td><td><a href="../album.php?id='+infos[5]+'" alt="Album page">+</a></td><td><button id="delete'+infos[5]+infos[6]+'" onclick="deletenot(1,'+infos[6]+','+infos[5]+')">Moderate</button></td></tr>';//lien à modifier

			}
			html += "</tbody></table";
			document.getElementById("workspace").innerHTML=html;
	    }
	}
	xhr.open("GET","database.php?choice=1",true);  
	xhr.send();
}


function notarizeArtist() {
	var xhr = new XMLHttpRequest();	 
	 
	xhr.onreadystatechange=function()
	{
	    if (xhr.readyState==4 && xhr.status==200)
	    {
	    	data=xhr.responseText;
	    	al = data.split(';');
	    	var infos="";
	    	var html="<table><thead><th>Agreement</th><th>Cause</th><th>Artist</th><th>User</th><th>More</th></thead>";
	    	for(var i=0;i<al.length-1;i++)
			{
				infos=al[i].split(",");
				html += '<tr><td>'+infos[0]+'</td><td>'+infos[1]+' </td><td>'+infos[2]+'</td><td>'+infos[3]
				     +'</td><td><a href="../artist.php?id='+infos[4]+'" alt="Artist page">+</a></td></tr>'; //lien à modifier

			}
			html += "</tbody></table";
			document.getElementById("workspace").innerHTML=html;
	    }
	}
	xhr.open("GET","lastaction.php?choice=1.2",true);  
	xhr.send();
}


function notarizeArtistDB() {
	var xhr = new XMLHttpRequest();	 
	 
	xhr.onreadystatechange=function()
	{
	    if (xhr.readyState==4 && xhr.status==200)
	    {
	    	data=xhr.responseText;
	    	al = data.split(';');
	    	var infos="";
	    	var html="<table><thead><th>Agreement</th><th>Cause</th><th>Artist</th><th>User</th><th>More</th></thead>";
	    	for(var i=0;i<al.length-1;i++)
			{
				infos=al[i].split(",");
				html += '<tr><td>'+infos[0]+'</td><td>'+infos[1]+' </td><td>'+infos[2]+'</td><td>'+infos[3]+'</td><td><a href="../artist.php?id='+infos[4]
				      +'" alt="Artist page">+</a></td><td><button id="delete'+infos[4]+infos[5]+'" onclick="deletenot(2,'+infos[5]+','+infos[4]+')">Moderate</button></td></tr>';//lien à modifier

			}
			html += "</tbody></table";
			document.getElementById("workspace").innerHTML=html;
	    }
	}
	xhr.open("GET","database.php?choice=2",true);  
	xhr.send();
}



function deletenot(sub,user,id)
{
	console.log("begin deletenot");
	console.log(sub+","+user+","+id);
	var xhr = new XMLHttpRequest();	 
	 
	xhr.onreadystatechange=function()
	{
	    if (xhr.readyState==4 && xhr.status==200)
	    {
	    	console.log('deletenot query ok');
	    	alert(xhr.responseText);
	    	if(sub==1)
	    	{
	    		database_show(3.2);
	    	}
	    	else if(sub==2)
	    	{
	    		database_show(3.1);
	    	}
	    }
	}
	xhr.open("GET",'database.php?not='+sub+'&user='+user+'&id='+id,true);  //bug complet, dans l'appel notarizealbumDB ça marche pas, tout semble correct pourtant, alors que pour artiste c'est qu'à moitié*..
	xhr.send();	
}




function lastAlbum()
{
	var xhr = new XMLHttpRequest();	 
	 
	xhr.onreadystatechange=function()
	{
	    if (xhr.readyState==4 && xhr.status==200)
	    {
	    	data=xhr.responseText;
	    	al = data.split(';');
	    	var infos="";
	    	var html="<table><thead><th>ID</th><th>Name</th><th>Artist</th><th>ReleaseDate</th><th>Upload Date</th><th>Upload User</th><th>Type</th><th>More</th></thead>";
	    	for(var i=0;i<al.length-1;i++)
			{
				infos=al[i].split(",");
				html += '<tr><td>'+infos[0]+'</td><td>'+infos[1]+' </td><td>'+infos[2]+'</td><td>'+infos[3]+'</td><td>'+infos[4]
				     +'</td><td>'+infos[5]+'</td><td>'+infos[6]+'</td><td><a href="../album.php?id='+infos[0]+'" alt="Album page">+</a></td></tr>';//lien a modifier

			}
			html += "</tbody></table";
			document.getElementById("workspace").innerHTML=html;
	    }
	}
	xhr.open("GET","lastaction.php?choice=1.3",true);  
	xhr.send();
}


function lastArtist()
{
	var xhr = new XMLHttpRequest();	 
	 
	xhr.onreadystatechange=function()
	{
	    if (xhr.readyState==4 && xhr.status==200)
	    {
	    	data=xhr.responseText;
	    	al = data.split(';');
	    	var infos="";
	    	var html="<table><thead><th>ID</th><th>Name</th><th>Upload Date</th><th>Upload User</th><th>More</th></thead>";
	    	for(var i=0;i<al.length-1;i++)
			{
				infos=al[i].split(",");
				html += '<tr><td>'+infos[0]+'</td><td>'+infos[1]+' </td><td>'+infos[2]+'</td><td>'+infos[3]+'</td><td><a href="../artist.php?id='+infos[0]+'" alt="Artist page">+</a></td></tr>';//lien a modifier

			}
			html += "</tbody></table";
			document.getElementById("workspace").innerHTML=html;
	    }
	}
	xhr.open("GET","lastaction.php?choice=1.4",true);  
	xhr.send();
}

function lastUser()
{
	var xhr = new XMLHttpRequest();	 
	 
	xhr.onreadystatechange=function()
	{
	    if (xhr.readyState==4 && xhr.status==200)
	    {
	    	data=xhr.responseText;
	    	al = data.split(';');
	    	var infos="";
	    	var html="<table><thead><th>ID</th><th>UserName</th><th>Mail</th><th>Public Mail</th><th>Active</th><th>More</th></thead>";
	    	for(var i=0;i<al.length-1;i++)
			{
				infos=al[i].split(",");

				if(infos[4]==1)
				{
					html += '<tr><td>'+infos[0]+'</td><td>'+infos[1]+' </td><td>'+infos[2]+'</td><td>'+infos[3]
					     +'</td><td>Yes</td><td><a href="../user.php?id='+infos[0]+'" alt="User page">+</a></td></tr>';//lien a modifier
				}
				else
				{
					html += '<tr><td>'+infos[0]+'</td><td>'+infos[1]+' </td><td>'+infos[2]+'</td><td>'+infos[3]
						 +'</td><td>No <button id=active'+infos[0]+' onclick=\'activateUser('+infos[0]+')\'>Activate</button></td><td> + </td></tr>';
				}
			}
			html += "</tbody></table";
			document.getElementById("workspace").innerHTML=html;
	    }
	}
	xhr.open("GET","lastaction.php?choice=1.5",true);  
	xhr.send();
}
 
function activateUser(id)
{

	var xhr = new XMLHttpRequest();
	xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
  		if(xmlhttp.readyState==4 && xmlhttp.status==200)
  		{
  			data=xhr.responseText;
  			console.log(data);
  			last_actions_show(1.5);
		}
	}
	xmlhttp.open("GET","lastaction.php?id="+id+"&choice=1.51",true);
	xmlhttp.send();
}

function lastConnection()
{
	var xhr = new XMLHttpRequest();	 
	 
	xhr.onreadystatechange=function()
	{
	    if (xhr.readyState==4 && xhr.status==200)
	    {
	    	data=xhr.responseText;
	    	al = data.split(';');
	    	var infos="";
	    	var html="<table><thead><th>ID</th><th>User</th><th>Ip</th><th>Date</th><th>Country</th><th>Os</th><th>Browser</th></thead>";
	    	for(var i=0;i<al.length-1;i++)
			{
				infos=al[i].split(",");
				html += '<tr><td>'+infos[0]+'</td><td>'+infos[1]+' </td><td>'+infos[2]+'</td><td>'+infos[3]
					 +'</td><td>'+infos[4]+'</td><td>'+infos[5]+'</td><td>'+infos[6]+'</td></tr>';

			}

			html += "</tbody></table";
			document.getElementById("workspace").innerHTML=html;
	    }
	}
	xhr.open("GET","lastaction.php?choice=1.6",true);  
	xhr.send();
}
