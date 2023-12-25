<?php 
    require('connexion-db.php');
    $requete = $connexion->prepare("SELECT SmartFlushXR,SmartFlushX,SmartFlushXplus FROM Panier WHERE mail = :mail");
    $requete->bindParam(":mail", $_SESSION['mail']);
    $requete->execute();
    $resultat = $requete->fetchAll();
    $res=$resultat[0];
    $SFXR=$res['SmartFlushXR'];
    $SFX=$res['SmartFlushX'];
    $SFXplus=$res['SmartFlushXplus'];
    $totalpanier=$SFXR+$SFX+$SFXplus;
    $requete = $connexion->prepare("SELECT prix FROM Toilettes");
    $requete->execute();
    $resultat = $requete->fetchAll();
    $prixtotal = $SFXR*$resultat[0]['prix']+$SFX*$resultat[1]['prix']+$SFXplus*$resultat[2]['prix'];
    echo '<script>';
    echo 'var prix1 = ' . $resultat[0]['prix'] . ';';
    echo 'var prix2 = ' . $resultat[1]['prix'] . ';';
    echo 'var prix3 = ' . $resultat[2]['prix'] . ';';
    echo 'var pt = ' . $prixtotal . ';';
    echo '</script>';
    echo '<div id="commande">';
    if ($totalpanier == 0){
        echo '<h1 id="Tcommande">Vous n\'avez aucune commande pour le moment</h1>';
    } else {
        echo '<div class="produit"><img src="imgs/SmartFlushXR.png" width="75px">SmartFlushXR ('.$resultat[0]['prix'].' €)<div class="compteur"><div id="m1" class="moins">-</div><h1 id="element1" class="cmpt">0</h1><div id="p1" class="plus">+</div></div></div>';
        echo '<div class="produit"><img src="imgs/SmartFlushX.png" width="100px">SmartFlushX ('.$resultat[1]['prix'].' €)<div class="compteur"><div id="m2" class="moins">-</div><h1 id="element2" class="cmpt">0</h1><div id="p2" class="plus">+</div></div></div>';
        echo '<div class="produit"><img src="imgs/SmartFlushXPROMAX.png" width="100px">SmartFlushX+ ('.$resultat[2]['prix'].' €)<div class="compteur"><div id="m3" class="moins">-</div><h1 id="element3" class="cmpt">0</h1><div id="p3" class="plus">+</div></div></div>';
    }
    echo '</div>';
    echo '<a id="prix">0 €</a>';
?>