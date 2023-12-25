<?php

$serveur = "localhost";
$utilisateur = "22205473";
$mdp = "741159";
$nomBaseDeDonnees = "db_SBERRO";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$nomBaseDeDonnees", $utilisateur, $mdp);
    
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}






if (isset($_POST["np1"]) || isset($_POST["np2"]) || isset($_POST["np3"])) {
    session_start();
    $np1 = $_POST["np1"];
    $np2 = $_POST["np2"];
    $np3 = $_POST["np3"];
    $requete = $connexion->prepare("UPDATE Panier SET SmartFlushXR = :np1, SmartFlushX = :np2, SmartFlushXplus = :np3 WHERE mail = :email");
    $requete->bindParam(":np1", $np1);
    $requete->bindParam(":np2", $np2);
    $requete->bindParam(":np3", $np3);
    $requete->bindParam(":email", $_SESSION['mail']);
    $requete->execute();
}



if (isset($_POST["ns1"]) || isset($_POST["ns2"]) || isset($_POST["ns3"])) {
    session_start();
    $ns1 = $_POST["ns1"];
    $ns2 = $_POST["ns2"];
    $ns3 = $_POST["ns3"];
    $requete = $connexion->prepare("UPDATE Toilettes SET stock = :ns1 WHERE id = 1");
    $requete->bindParam(":ns1", $ns1);
    $requete->execute();

    $requete = $connexion->prepare("UPDATE Toilettes SET stock = :ns2 WHERE id = 2");
    $requete->bindParam(":ns2", $ns2);
    $requete->execute();

    $requete = $connexion->prepare("UPDATE Toilettes SET stock = :ns3 WHERE id = 3");
    $requete->bindParam(":ns3", $ns3);
    $requete->execute();
}

if (isset($_POST["p1"]) || isset($_POST["p2"]) || isset($_POST["p3"])) {
    session_start();
    $panier1 = $_POST["p1"];
    $panier2 = $_POST["p2"];
    $panier3 = $_POST["p3"];
    $requete = $connexion->prepare("UPDATE Panier SET SmartFlushXR = :p1, SmartFlushX = :p2, SmartFlushXplus = :p3 WHERE mail = :email");
    $requete->bindParam(":email", $_SESSION['mail']);
    $requete->bindParam(":p1", $panier1);
    $requete->bindParam(":p2", $panier2);
    $requete->bindParam(":p3", $panier3);
    $requete->execute();

    $requete = $connexion->prepare("UPDATE Toilettes SET stock = :ns2 WHERE id = 2");
    $requete->bindParam(":ns2", $ns2);
    $requete->execute();

    $requete = $connexion->prepare("UPDATE Toilettes SET stock = :ns3 WHERE id = 3");
    $requete->bindParam(":ns3", $ns3);
    $requete->execute();
}

$outils='';
if (!empty($_SESSION['mail'])){
    if ($_SESSION!=array()){
        $deconnexion = '<a href="profil.php" id="profil"><img src="imgs/homme.png" width="30px"></a><a class="Tlogin" id="Tlogin1" href="login.php" onclick="deconnexion()">Se déconnecter</a>';
        $requete = $connexion->prepare("SELECT droits FROM Utilisateur WHERE mail = :email");
        $requete->bindParam(":email", $_SESSION['mail']);
        $requete->execute();
        $resultat = $requete->fetch();
        $droits = $resultat['droits'];
        
        $requete = $connexion->prepare("SELECT SmartFlushXR, SmartFlushX, SmartFlushXplus FROM Panier WHERE mail = :email");
        $requete->bindParam(":email", $_SESSION['mail']);
        $requete->execute();
        $resultat2 = $requete->fetch();
        $p1 = $resultat2['SmartFlushXR'];
        $p2 = $resultat2['SmartFlushX'];
        $p3 = $resultat2['SmartFlushXplus'];
        $ptotal=$p1+$p2+$p3;
        
        $requete = $connexion->prepare("SELECT stock FROM Toilettes WHERE id = 1");
        $requete->execute();
        $resultat4 = $requete->fetch();
        $s1 = $resultat4['stock'];
        
        $requete = $connexion->prepare("SELECT stock FROM Toilettes WHERE id = 2");
        $requete->execute();
        $resultat5 = $requete->fetch();
        $s2 = $resultat5['stock'];
        
        $requete = $connexion->prepare("SELECT stock FROM Toilettes WHERE id = 3");
        $requete->execute();
        $resultat6 = $requete->fetch();
        $s3 = $resultat6['stock'];
        
        $requete = $connexion->prepare("SELECT SmartFlushXR,SmartFlushX,SmartFlushXplus FROM Panier WHERE mail = :email");
        $requete->bindParam(":email", $_SESSION['mail']);
        $requete->execute();
        $resultat = $requete->fetch();
        $panier1 = $resultat['SmartFlushXR'];
        $panier2 = $resultat['SmartFlushX'];
        $panier3 = $resultat['SmartFlushXplus'];

        if ($droits != "restreint") {
            $outils= '<a href="gestion.php" id="outils"><img src="imgs/outils.ico" width="75px"></a>';
        } else {
            $outils='';
        }
    } else {
        $deconnexion = '<a class="Tlogin" id="Tlogin1" href="login.php">S\'inscrire</a><a class="Tlogin" id="Tlogin2" href="login.php">Se connecter</a>';
    }
} else {
    $ptotal=0;
    $deconnexion = '<a class="Tlogin" id="Tlogin1" href="login.php">S\'inscrire</a><a class="Tlogin" id="Tlogin2" href="login.php">Se connecter</a>';
};

echo '<script>';
echo 'var np1 = ' . $p1 . ';';
echo 'var np2 = ' . $p2 . ';';
echo 'var np3 = ' . $p3 . ';';
echo 'var nbrpanier = ' . $ptotal . ';';
echo 'var ns1 = ' . $s1 . ';';
echo 'var ns2 = ' . $s2 . ';';
echo 'var ns3 = ' . $s3 . ';';
echo 'var p1 = ' . $panier1 . ';';
echo 'var p2 = ' . $panier2 . ';';
echo 'var p3 = ' . $panier3 . ';';
echo '</script>';





if (isset($_POST['login0']) || isset($_POST['mdp0']) || isset($_POST['nvemail0']) || isset($_POST['adresse0']) || isset($_POST['cp0'])){
    $requete = $connexion->prepare("SELECT id FROM Utilisateur WHERE mail = :email");
    $requete->bindParam(":email", $_SESSION['mail']);
    $requete->execute();
    $resultat3 = $requete->fetch();
    $id = $resultat3['id'];
    if ($_POST['login0']!=''){$login=$_POST['login0'];} else {$login=$_SESSION['login'];}
    if ($_POST['mdp0']!=''){$mdp=password_hash($_POST['mdp0'], PASSWORD_DEFAULT);} else {$mdp=$_SESSION['mdp'];}
    if ($_POST['nvemail0']!=''){$email=$_POST['nvemail0'];} else {$email=$_SESSION['mail'];}
    if ($_POST['adresse0']!=''){$rue=$_POST['adresse0'];} else {$rue=$_SESSION['adresse'];}
    if ($_POST['cp0']!=''){$cp=$_POST['cp0'];} else {$cp=$_SESSION['cp'];}
    $requete = $connexion->prepare("UPDATE Utilisateur SET id = :id, login = :login, mdp = :mdp, mail = :nvemail, rue = :adresse, cp = :cp WHERE mail = :email");
    $requete->bindParam(":id", $id);
    $requete->bindParam(":login", $login);
    $requete->bindParam(":mdp", $mdp);
    $requete->bindParam(":nvemail", $email);
    $requete->bindParam(":email", $_SESSION['mail']);
    $requete->bindParam(":adresse", $rue);
    $requete->bindParam(":cp", $cp);
    $requete->execute();
    $requete = $connexion->prepare("UPDATE Panier SET mail = :nvemail WHERE mail = :email");
    $requete->bindParam(":nvemail", $email);
    $requete->bindParam(":email", $_SESSION['mail']);
    $requete->execute();

    $_SESSION['login']=$login;
    $_SESSION['mdp']=$mdp;
    $_SESSION['mail']=$email;
    $_SESSION['adresse']=$rue;
    $_SESSION['cp']=$cp;
}



?>