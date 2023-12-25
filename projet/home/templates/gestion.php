<?php
session_start();
if ($_SESSION['droits'] == 'restreint') {
    header('Location: HTTP/1.0 403 Forbidden');
    echo "Accès refusé. Vous n'êtes pas autorisé à accéder à ce fichier.";
}
require('connexion-db.php');


?>







<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<style>@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@700&family=Cinzel&family=Erica+One&family=Syncopate&family=Kanit:wght@800&family=Montserrat:wght@300&Oswald:wght@500&family=Ramabhadra&family=Work+Sans:wght@300&display=swap');</style>
<script crossorigin="anonymous" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" src="https://code.jquery.com/jquery-3.6.0.js"></script>
<title>Smart Flush</title>
<link rel="shortcut icon" href="imgs/wc.ico" type="image/x-icon">
</head>
<body>
<script>
				$(window).bind('load',function(){
					$('#load').css({
						'opacity' : '0'
					});
					$('#load').css({
						'z-index' : '-1000'
					});
				});
				$(window).ready(function(){
					if ($(window).width() <= 768) {  
						$(".Tall").click(function(){
							$("#mtopbar").css({
								"left" : "-100vw"
							});
							$("#mb2").css({
								"color" : "white"
							});
							$("#mb1").css({
								"right" : "20px",
								"transform" : "rotate(0deg)"
							});
							$("#mb3").css({
								"left" : "20px",
								"transform" : "rotate(0deg)"
							});
							$("#mtopbar").css({
								"left" : "-100vw"
							});
						});
					}
				});
				$(window).resize(function(){
					if ($(window).width() <= 768) {
						$(".Tall").click(function(){
							$("#mtopbar").css({
								"left" : "-100vw"
							});
							$("#mb2").css({
								"color" : "white"
							});
							$("#mb1").css({
								"right" : "20px",
								"transform" : "rotate(0deg)"
							});
							$("#mb3").css({
								"left" : "20px",
								"transform" : "rotate(0deg)"
							});
							$("#mtopbar").css({
								"left" : "-100vw"
							});
						});
					}
				});
				$(window).on('scroll',function() {
					var scrollTop = $(window).scrollTop();
					if ( scrollTop > $('.filtre').offset().top ) { 
						$('#div4').css({
							'opacity' : '1',
							'left' : '10vw',
							'box-shadow' : '-50px 0px 0px rgba(26, 196, 187, 15%)'
						})
						$('#p1').css({
							'opacity' : '1'
						})
						$('#p1').css({
							'margin-bottom' : '0'
						})
					}
				});
				$(document).ready(function(){
					let bouton=0
					$("#left_arrow").click(function(){
						$("#img1").css({
							"width" : "700px",
							"height" : "400px",
							"left" : "calc(50% - 350px)",
							"opacity" : "1",
							"z-index" : "2"
						});
						$("#img2").css({
							"width" : "500px",
							"height" : "300px",
							"margin-left" : "57.5%",
							"opacity" : "0",
							"z-index" : "1"
						});
						$("#img3").css({
							"width" : "500px",
							"height" : "300px",
							"right" : "-15%",
							"opacity" : "0"
						});
						$("#right_arrow").css({
							"z-index" : "3"
						});
						$("#right_arrow2").css({
							"z-index" : "4"
						});
						$("#div3").css({
							"background-color" : "#3155ad"
						});
						$("#tl1-1").css({
							"transform" : "rotate3d(0,0,0,0deg)",
							"opacity" : "1"
						});
						$("#tl2-1").css({
							"transform" : "rotate3d(0,1,0,180deg)",
							"opacity" : "0"
						});
						$(".abc1").css({
							"opacity" : "1",
							"z-index" : "1"
						});
						$(".abc2").css({
							"opacity" : "0",
							"z-index" : "0"
						});
						$("#div4").css({
							"height" : "55vh"
						});
					});
					$("#left_arrow2").click(function(){
						$("#img1").css({
							"width" : "500px",
							"height" : "300px",
							"left" : "7.5%",
							"opacity" : "0",
							"z-index" : "1"
						});
						$("#img2").css({
							"width" : "700px",
							"height" : "400px",
							"margin-left" : "0",
							"opacity" : "1",
							"z-index" : "2"
						});
						$("#img3").css({
							"width" : "500px",
							"height" : "300px",
							"right" : "7.5%",
							"opacity" : "0",
							"z-index" : "1"
						});
						$("#left_arrow").css({
							"z-index" : "4"
						});
						$("#left_arrow2").css({
							"z-index" : "3"
						});
						$("#right_arrow").css({
							"z-index" : "4"
						});
						$("#right_arrow2").css({
							"z-index" : "3"
						});
						$("#div3").css({
							"background-color" : "#a2dae4"
						});
						$("#tl2-1").css({
							"transform" : "rotate3d(0,1,0,0deg)",
							"opacity" : "1"
						});
						$("#tl3-1").css({
							"transform" : "rotate3d(0,1,0,180deg)",
							"opacity" : "0"
						});
						$(".abc2").css({
							"opacity" : "1",
							"z-index" : "1"
						});
						$(".abc3").css({
							"opacity" : "0",
							"z-index" : "0"
						});
						$("#div4").css({
							"height" : "75vh"
						});
					});
					$("#right_arrow").click(function(){
						$("#img1").css({
							"width" : "500px",
							"height" : "300px",
							"left" : "-15%",
							"opacity" : "0",
							"z-index" : "1"
						});
						$("#img2").css({
							"width" : "500px",
							"height" : "300px",
							"margin-left" : "-57.5%",
							"opacity" : "0",
							"z-index" : "1"
						});
						$("#img3").css({
							"width" : "700px",
							"height" : "400px",
							"right" : "calc(50% - 350px)",
							"opacity" : "1",
							"z-index" : "2"
						});
						$("#left_arrow").css({
							"z-index" : "3"
						});
						$("#left_arrow2").css({
							"z-index" : "4"
						});
						$("#div3").css({
							"background-color" : "#393b40"
						});
						$("#tl2-1").css({
							"transform" : "rotate3d(0,1,0,180deg)",
							"opacity" : "0"
						});
						$("#tl3-1").css({
							"transform" : "rotate3d(0,0,0,0deg)",
							"opacity" : "1"
						});
						$(".abc3").css({
							"opacity" : "1",
							"z-index" : "1"
						});
						$(".abc2").css({
							"opacity" : "0",
							"z-index" : "0"
						});
						$("#div4").css({
							"height" : "55vh"
						});
					});
					$("#right_arrow2").click(function(){
						$("#img1").css({
							"width" : "500px",
							"height" : "300px",
							"left" : "7.5%",
							"opacity" : "0",
							"z-index" : "1"
						});
						$("#img2").css({
							"width" : "700px",
							"height" : "400px",
							"margin-left" : "0",
							"opacity" : "1",
							"z-index" : "2"
						});
						$("#img3").css({
							"width" : "500px",
							"height" : "300px",
							"right" : "7.5%",
							"opacity" : "0",
							"z-index" : "1"
						});
						$("#left_arrow").css({
							"z-index" : "4"
						});
						$("#left_arrow2").css({
							"z-index" : "3"
						});
						$("#right_arrow").css({
							"z-index" : "4"
						});
						$("#right_arrow2").css({
							"z-index" : "3"
						});
						$("#div3").css({
							"background-color" : "#a2dae4"
						});
						$("#tl2-1").css({
							"transform" : "rotate3d(0,1,0,0deg)",
							"opacity" : "1"
						});
						$("#tl1-1").css({
							"transform" : "rotate3d(0,1,0,180deg)",
							"opacity" : "0"
						});
						$(".abc2").css({
							"opacity" : "1",
							"z-index" : "1"
						});
						$(".abc1").css({
							"opacity" : "0",
							"z-index" : "0"
						});
						$("#div4").css({
							"height" : "75vh"
						});
					});
					$("#menu").click(function(){
						if (bouton==0) {
							$("#mb2").css({
								"position" : "absolute",
								"color" : "white"
							});
							$("#mb1").css({
								"right" : "10px",
								"transform" : "rotate(45deg)"
							});
							$("#mb3").css({
								"left" : "10px",
								"transform" : "rotate(-45deg)"
							});
							$("#mtopbar").css({
								"left" : "0"
							});
							bouton=1
						}
						else {
							$("#mb2").css({
								"color" : "rgb(38, 38, 38)"
							});
							$("#mb1").css({
								"right" : "20px",
								"transform" : "rotate(0deg)"
							});
							$("#mb3").css({
								"left" : "20px",
								"transform" : "rotate(0deg)"
							});
							$("#mtopbar").css({
								"left" : "-100vw"
							});
							bouton=0
						}
					});
				});
			</script>

<div id="load"><div id="dot1"></div><div id="dot2"></div></div>
<div id="topbar"><b>
	<img href="panier.php" id="logo" src="imgs/wc.png">
	<a id="Tlogo" href="index.php">SMARTFLUSH</a>
	<div id="menu">
	<h1 class="menubar" id="mb1">|</h1>
	<h1 class="menubar" id="mb2">|</h1>
	<h1 class="menubar" id="mb3">|</h1>
	</div>
	<div id="mtopbar">
	<a href="index.php" id="logo"></a>
	<a class="Tall" href="index.php">Nos produits</a>
	<a class="Tall" href="nous.php">Qui sommes-nous ?</a>
	<a class="Tall" href="contact.php">Nous contacter</a>
	</div>
	<div id="dlogin">
		<?php echo $deconnexion;?>
		<a href="panier.php">
			<img id="logo-panier" src="imgs/panier.png">
			<div id="nbr-panier">0</div>
		</a>
	</div></b>
</div>
<div id="div1">
	<div id="dstockuser">
		<div class="stockuser" id="stock">
            <h1 class="Tloginall" id="Tlaprofil">Stocks</h1>
			<div id="dstock">
				<div class="stock-produit">
					<img src="imgs/SmartFlushXR.png" width="150px">
					<div class="compteur"><div id="m1" class="moins">-</div><h1 id="element1" class="cmpt">0</h1><div id="p1" class="plus">+</div></div>
				</div>
				<div class="stock-produit">
					<img src="imgs/SmartFlushX.png" width="210px">
					<div class="compteur"><div id="m2" class="moins">-</div><h1 id="element2" class="cmpt">0</h1><div id="p2" class="plus">+</div></div>
				</div>
				<div class="stock-produit">
					<img src="imgs/SmartFlushXPROMAX.png" width="225px">
					<div class="compteur"><div id="m3" class="moins">-</div><h1 id="element3" class="cmpt">0</h1><div id="p3" class="plus">+</div></div>
				</div>
			</div>
		</div>
		<div class="stockuser" id="user">
            <h1 class="Tloginall" id="Tlaprofil">Utilisateurs</h1>
			<div id="duser">
				<?php require('utilisateurs.php')?>
			</div>
		</div>
	</div>
	
<footer>
  <p>&copy; 2023 SmartFlush. Tous droits réservés.</p>
</footer>
</div>
</body>
</html>

<script>


document.getElementById("element1").innerHTML = ns1;
document.getElementById("element2").innerHTML = ns2;
document.getElementById("element3").innerHTML = ns3;

document.getElementById("m1").addEventListener("click", function() {
    ns1 -= 1;
    document.getElementById("element1").innerHTML = ns1;
	$.ajax({
		type: 'POST',
		url : 'connexion-db.php',
		data : {ns1 : ns1, ns2 : ns2, ns3 : ns3}
	});
});
document.getElementById("p1").addEventListener("click", function() {
    ns1 += 1;
    document.getElementById("element1").innerHTML = ns1;
	$.ajax({
		type: 'POST',
		url : 'connexion-db.php',
		data : {ns1 : ns1, ns2 : ns2, ns3 : ns3}
	});
});

document.getElementById("m2").addEventListener("click", function() {
    ns2 -= 1;
    document.getElementById("element2").innerHTML = ns2;
	$.ajax({
		type: 'POST',
		url : 'connexion-db.php',
		data : {ns1 : ns1, ns2 : ns2, ns3 : ns3}
	});
});
document.getElementById("p2").addEventListener("click", function() {
    ns2 += 1;
    document.getElementById("element2").innerHTML = ns2;
	$.ajax({
		type: 'POST',
		url : 'connexion-db.php',
		data : {ns1 : ns1, ns2 : ns2, ns3 : ns3}
	});
});

document.getElementById("m3").addEventListener("click", function() {
    ns3 -= 1;
    document.getElementById("element3").innerHTML = ns3;
	$.ajax({
		type: 'POST',
		url : 'connexion-db.php',
		data : {ns1 : ns1, ns2 : ns2, ns3 : ns3}
	});
});
document.getElementById("p3").addEventListener("click", function() {
    ns3 += 1;
    document.getElementById("element3").innerHTML = ns3;
	$.ajax({
		type: 'POST',
		url : 'connexion-db.php',
		data : {ns1 : ns1, ns2 : ns2, ns3 : ns3}
	});
});



document.getElementById("nbr-panier").innerHTML = nbrpanier;


function deconnexion(){
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'deconnexion.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.responseText);
    }
  };
  xhr.send();
}
</script>