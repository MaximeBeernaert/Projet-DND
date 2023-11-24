<?php
// connexion à la base de données
include_once('./Config.php');

// inclusion des classes
include_once('./Classes/Personnage.php');
include_once('./Classes/Monstre.php');
include_once('./Classes/Salle.php');
include_once('./Classes/Porter.php');
include_once('./Classes/Objet.php');

// inclusion des DAO
include_once ('./DAO/PersonnageDAO.php');
include_once ('./DAO/MonstreDAO.php');
include_once ('./DAO/SalleDAO.php');
include_once ('./DAO/PorterDAO.php');
include_once ('./DAO/ObjetDAO.php');
include_once ('./DAO/EnigmeDAO.php');

// instanciation des DAO
$personnageDAO = new PersonnageDAO($db);
$monstreDAO = new MonstreDAO($db);
$salleDAO = new SalleDAO($db);
$porterDAO = new PorterDAO($db);
$objetDAO = new ObjetDAO($db);
$enigmeDAO = new EnigmeDAO($db);
$gestionDAO = array('personnageDAO' => $personnageDAO, 'monstreDAO' => $monstreDAO, 'salleDAO' => $salleDAO, 'porterDAO' => $porterDAO, 'objetDAO' => $objetDAO, 'enigmeDAO' => $enigmeDAO);




// $monstre1 = new Monstre("Dragon", 100, 20, "Souffle de feu", 10, 500);
// $monstreDAO->addMonstre($monstre);
// $monstre2 = new Monstre("Gobelin", 10, 5, "Attaque de base", 5, 100);
// $monstreDAO->addMonstre($monstre);
// $monstre3 = new Monstre("Ogre", 120, 25, "Frappe puissante", 15, 600);
// $monstreDAO->addMonstre($monstre);
// $monstre4 = new Monstre("Spectre", 80, 15, "Toucher glacial", 8, 300);
// $monstreDAO->addMonstre($monstre);
// $monstre5 = new Monstre("Banshee", 90, 18, "Cri perçant", 12, 400);
// $monstreDAO->addMonstre($monstre);
// $monstre6 = new Monstre("Loup-garou", 110, 22, "Morsure féroce", 12, 550);
// $monstreDAO->addMonstre($monstre);
// $monstre7 = new Monstre("Chimère", 150, 30, "Rugissement dévastateur", 20, 700);
// $monstreDAO->addMonstre($monstre);
// $monstre8 = new Monstre("Hydre", 180, 35, "Morsure venimeuse", 25, 800);
// $monstreDAO->addMonstre($monstre);
// $monstre9 = new Monstre("Orc", 80, 12, "Frappe brutale", 10, 300);
// $monstreDAO->addMonstre($monstre);
// $monstre10 = new Monstre("Elemental", 200, 40, "Furie élémentaire", 30, 1000);
// $monstreDAO->addMonstre($monstre);
// $monstre11 = new Monstre("Golem", 250, 45, "Frappe de pierre", 35, 1200);
// $monstreDAO->addMonstre($monstre);
// $monstre12 = new Monstre("Géant", 300, 50, "Frappe dévastatrice", 40, 1500);
// $monstreDAO->addMonstre($monstre);
// $monstre13 = new Monstre("Squelette", 50, 8, "Attaque de base", 5, 200);
// $monstreDAO->addMonstre($monstre);
// $monstre14 = new Monstre("Zombie", 60, 10, "Morsure infectée", 8, 250);
// $monstreDAO->addMonstre($monstre);
// $monstre15 = new Monstre("Vampire", 70, 12, "Morsure vampirique", 10, 300);
// $monstreDAO->addMonstre($monstre);
// $monstre16 = new Monstre("Liche", 100, 15, "Toucher glacial", 12, 400);
// $monstreDAO->addMonstre($monstre);
// $monstre17 = new Monstre("Démon", 150, 20, "Frappe démoniaque", 15, 600);
// $monstreDAO->addMonstre($monstre);



// $personnage = new Personnage('Yohann');
// $gestionDAO['personnageDAO']->addPersonnage($personnage);

// $monstre = new Monstre('Gobelin',10, 10, 'Attaque de base', 5, 10);
// $monstreDAO->addMonstre($monstre);


// MENU DEBUT DE JEU
function menu($gestionDAO){
    popen('cls','w');
    echo "Bienvenue Joueur";
    echo "Veux-tu : \n 1 - Charger une nouvelle partie \n2 - Charger une partie déjà créée \n3 - Quitter";
    $choice = readline("");
    switch ($choice) {
        case '1':
            $personnage = createPersonnage($gestionDAO);
            menuJoueur($gestionDAO, $personnage);
            break;
        case '2':
            $personnage = chargerPartie($gestionDAO);
            menuJoueur($gestionDAO, $personnage);
            break;
        case '3':
            exitGame();
            break;
        default:
            menu($gestionDAO);
            exit;
    }
}

// CREER UN PERSONNAGE
function createPersonnage($gestionDAO){
    popen('cls','w');
    $nom = readline(("Quel est le nom de votre personnage ?"));
    $personnage = new Personnage($nom);
    $gestionDAO['personnageDAO']->addPersonnage($personnage);
    $id = $gestionDAO['personnageDAO']->getLastPersonnageId()[0];
    $personnage->setId($id);
    return $personnage;
}

// CHARGER UNE PARTIE
function chargerPartie($gestionDAO){
    popen('cls','w');
    $gestionDAO['personnageDAO']->getPersonnages();
    echo "Choisir une partie :\n";
    foreach ($gestionDAO['personnageDAO']->getPersonnages() as $key => $personnage) {
        echo $key+1 . ' - ' . $personnage['nom'] . " - Niveau: " . $personnage['level'] . "\n";
    }
    echo "Quel est le numéro de votre partie ?";
    $choix = (int)readline("");
    if($choix <= 0 || $choix > count($gestionDAO['personnageDAO']->getPersonnages()) ){
        chargerPartie($gestionDAO);
    }
    $tempPersonnage = $gestionDAO['personnageDAO']->getPersonnage($gestionDAO['personnageDAO']->getPersonnages()[$choix]['id']);
    
    popen('cls','w');
    echo "Vous avez choisi la partie de " . $tempPersonnage['nom'] . "\n";
    readline("Appuyer sur entrer pour continuer");

    $personnage = new Personnage($tempPersonnage['nom'],1$tempPersonnage['pv'],$tempPersonnage['atk'],$tempPersonnage['def'],$tempPersonnage['exp'],$tempPersonnage['level'],$tempPersonnage['maxpv'],$tempPersonnage['maxdef'],$tempPersonnage['maxatk']);
    
    return $personnage;
}

// MENU PERSONNAGE 
function menuJoueur($gestionDAO, $personnage){
    // stat, inventaire, avancer salle, quitter
    updatePerso($gestionDAO, $personnage);
    popen('cls','w');
    echo ("Que souhaitez-vous faire ? \n1-Voir vos stats \n2-voir son inventaire \n3-avancer à la prochaine salle \n4-quitter");
    $choice = readline("");
    switch ($choice) {
        case '1':
            afficherPersonnage($gestionDAO, $personnage);
            break;
        case '2':
            voirInventaire($gestionDAO, $personnage);
            break;
        case '3':
            avancerSalle();
            break;
        case '4';
            exitGame();
            break;
        default:
            menuJoueur($gestionDAO, $personnage);
            break;
    }
    
}

// STATS PERSONNAGES ET OBJETS
function afficherPersonnage($gestionDAO, $personnage){
    updatePerso($gestionDAO, $personnage);
    popen('cls', 'w');
    echo 'Nom : ' . $personnage->getName() . "\n";
    echo 'PV : ' . $personnage->getPv() . "\n";
    echo 'Attaque : ' . $personnage->getAtk() . "\n";
    echo 'Défense : ' . $personnage->getDef() . "\n";
    echo 'Expérience : ' . $personnage->getExp() . "\n";
    echo 'Niveau : ' . $personnage->getLevel() . "\n";
    readline("Appuyer sur entrer pour continuer");
    menuJoueur($gestionDAO, $personnage);
}

function voirInventaire($gestionDAO, $personnage){
    popen('cls', 'w');
    $porters = $gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId());
    if($porters == null){
        echo "Vous n'avez pas d'objets !\n";
        readline("Appuyez sur Entrée");
        menuJoueur($gestionDAO, $personnage);
    }
    echo "Vos objets sont : \n\n";
    foreach($porters as $key => $porter){
        $objet = $gestionDAO['objetDAO']->getObjet($porter['idObj']);
        echo $key+1 . " - " . $objet['nom'] . " - " . $objet['desc'] . "\n";
    }
    
    echo "\n\nQue souhaitez-vous faire ?\n\n
        1 - Jeter un objet\n
        2- Retour\n\n";
    $choix = (INT)readline("Entrez votre choix : ");
    if($choix < 1 || $choix > 2){
        voirInventaire($gestionDAO, $personnage);
    }
    switch($choix){
        case 1 :
            jeterObjet($gestionDAO, $personnage);
            break;
        case 2 :
            menuJoueur($gestionDAO, $personnage);
            break;
    }
}

function jeterObjet($gestionDAO, $personnage){
    popen('cls', 'w');
    echo "Quel objet souhaitez-vous jeter ?\n\n";
    $gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId());
    foreach($gestionDAO['porterDAO']->getPorter() as $key => $porter){
        $objet = $gestionDAO['objetDAO']->getObjet($porter['idObj']);
        echo $key+1 . " - " . $objet['nom'] . " - " . $objet['desc'] . "\n";
    }
    echo $key+2 . " - Retour\n\n";
    
    $choix = (int)readline('Numéro de l\'objet que vous souhaitez jeter : ');
    if($choix < 1 || $choix > count($gestionDAO['porterDAO']->getPorter())+1){
        jeterObjet($personnage);
    }

    if ($choix == count($gestionDAO['porterDAO']->getPorter())+1) {
        voirInventaire($personnage);
    }

    $objet = $gestionDAO['objetDAO']->getObjet($gestionDAO['porterDAO']->getPorter()[$choix-1]['idObj']);
    $gestionDAO['porterDAO']->deletePorter($gestionDAO['porterDAO']->getPorter()[$choix-1]['id']);
    echo "Vous avez jeté l'objet " . $objet['nom'] . "\n\n";
    readline("Appuyer sur entrer pour continuer");
    voirInventaire($personnage);
}


// LEVEL-UP ET MAJ STATS

function updatePerso($gestionDAO, $personnage){
    $personnage->setPv($personnage->getMaxpv());
    $personnage->setDef($personnage->getMaxdef());
    $personnage->setAtk($personnage->getMaxatk());
    $personnage->setDodge(0);
    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);

    $porters = $gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId());
    foreach($porters as $key => $porter){
        $objet = $gestionDAO['objetDAO']->getObjet($porter['idObj']);
        $personnage->setPv($personnage->getPv() + $objet['heal']);
        $personnage->setAtk($personnage->getAtk() + $objet['atk']);
        $personnage->setDef($personnage->getDef() + $objet['def']);
        $personnage->setDodge($personnage->getDodge() + $objet['dodge']);
    }
    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
}

function levelUp($gestionDAO, $personnage){
    if($personnage->getExp() < $personnage->getLevel()*200){
        echo "Vous n'avez pas assez d'expérience pour gagner un niveau !\n";
        readline("Appuyer sur entrer pour continuer");
        menuJoueur($gestionDAO['personnageDAO'], $personnage);
    }
    $personnage->setLevel($personnage->getLevel() + 1);
    $personnage->setExp(0);
    $personnage->setMaxpv($personnage->getMaxpv() + 10);
    $personnage->setMaxdef($personnage->getMaxdef() + 5);
    $personnage->setMaxatk($personnage->getMaxatk() + 5);
    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
    updatePerso($personnage);
    echo "Vous avez gagné un niveau !\n";
    readline("Appuyer sur entrer pour continuer");
    menuJoueur($gestionDAO['personnageDAO'], $personnage);
}


// ACTION SALLE

function avancerSalle($gestionDAO, $personnage){
    popen('cls', 'w');

    echo "Vous avancez vers la salle";
    $niveau = $personnage->getLevel();
    // à  changer pour les stats (augmenter ennemis, réduire marchands, etc.)
    $ennemie = rand(1,5);
    $piege = rand(0,1);
    $enigme = rand(0,1);
    $marchand = rand(0,1);
    
    $salle = new Salle($niveau, $ennemie, $piege, $enigme, $marchand);
    $gestionDAO['salleDAO']>addSalle($salle);

    readline("Appuyer sur entrer pour continuer");

    if($salle->getEnigme() > 0){
        doEnigme($personnage, $gestionDAO);
    }

    if($salle->getPiege() > 0){
        activerPiege($personnage, $gestionDAO);
    }
    if($salle->getEnnemie() > 0){
        $listeMonstres = [];
        $monstres = showMonstre($gestionDAO['monstreDAO'], $gestionDAO['personnageDAO'], $personnage);
        for($i; $i<$salle->getEnnemie(); $i++){
            $random = rand(0, count($monstres));
            $monstre = $monstreArray[$i];
            array_push($listeMonstres, $monstre);
        }

        combatSalle($personnage, $listeMonstres, $gestionDAO);
        ouvrirCoffre($personnage, $gestionDAO);
    }
    if($salle->getMarchand() > 0){
        marchander($personnage, $gestionDAO['objetDAO']);
    }
    menuJoueur($gestionDAO['personnageDAO'], $personnage);
}

function showMonstre($gestionDAO, $personnage){
    $monstres = $gestionDAO['monstreDAO']->getAllMonstre();
    $niveau = $gestionDAO['personnageDAO']->getPersonnageNiveau($personnage);
    $monstreArray = [];
    
    foreach ($monstres as $monstre) {
        if($monstre['exp'] <= 100 * $niveau){
            array_push($monstreArray, $monstre);
        }
    }
    return $monstreArray;
}

function doEnigme($personnage, $gestionDAO) {
    popen('cls', 'w');
    echo "Vous entrez dans la salle et voyez une énigme. \n\n";
    $random = rand(1, count($gestionDAO['enigmeDAO']->getEnigmes()));
    $enigme = $gestionDAO['enigmeDAO']->getEnigme($random);
    echo $enigme['intitule'] . "\n\n";
    $reponse = readline("Votre réponse : ");
    if(strtolower($reponse) == strtolower($enigme['reponse'])){
        echo "Bonne réponse !\n\n";
        $personnage->setExp($personnage->getExp() + 100);
        $personnage->setPv($personnage->getPv() + 10);
        $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
        readline("Appuyer sur entrer pour continuer");
    }
    else{
        echo "Mauvaise réponse !\n\n";
        readline("Appuyer sur entrer pour continuer");
    }
}

function ouvrirCoffre($personnage, $gestionDAO){
    popen('cls', 'w');
    $isMimic = rand(0,10);
    $choix = (int)readline("Voulez-vous ouvrir le coffre ?\n1 - Oui\n2 - Non\n\nVotre choix : ");
    if($choix < 1 || $choix > 2){
        ouvrirCoffre($personnage);
    }
    if($choix == 1){
        if($isMimic == 10){
            echo "Le coffre était un Mimic !\n\nVous perdez " . $personnage->getNiveau() * 10 . "PV\n\n";
            $personnage->setPv($personnage->getPv() - $personnage->getNiveau() * 10);
            readline("Appuyer sur entrer pour continuer");
        }else{
            echo "Le coffre contient : \n\n";
            $gestionDAO['objetDAO']->getObjets();
            $marchand = [];
            $random = rand(0, count($gestionDAO['objetDAO']->getObjets()));
            $objet = $gestionDAO['objetDAO']->getObjet($random);
            array_push($marchand, $objet);
            echo "1 - " . $objet['nom'] . "\n";
            $objet = creationObjet($gestionDAO);
            array_push($marchand, $objet);
            echo "2 - " . $objet['nom'] . "\n";
            $personnage->setExp($personnage->getExp() + ($personnage->getNiveau() * 10));
            echo "Vous gagnez " . $personnage->getNiveau() * 10 . " points d'expérience\n\n";
            $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
            echo "Choisissez un objet à prendre entre les deux :";
            $choix = (int)readline("Votre choix : ");
            if($choix < 1 || $choix > 2){
                echo "Le coffre se referme de manière violente, bloquant l'accès à son contenu jusqu'au prochain aventurier\n\n";
            }else{
                $objet = $gestionDAO['objetDAO']->getObjet($marchand[$choix-1]['idObj']);
                $porter = new Porter($personnage->getId(), $objet['id']);
                $gestionDAO['porterDAO']->addPorter($porter);
                echo "Vous avez pris l'objet " . $objet['nom'] . "\n\n";
            }
            readline();
        }
    }
}

function activerPiege($gestionDAO, $personnage){
    popen('cls', 'w');
    
    $dodge = $gestionDAO['personnageDAO']->getDodge();
    echo "Vous avez activé un piège.";
    if($dodge == 0){
        $personnage->setPv($personnage->getPv() - $personnage->getNiveau() * 10);
        echo "Vous n'avez pas réussi a dodge le piège.\n";
        echo "Vous perdez ". ($personnage->getNiveau() * 10) ." points de vie, il vous reste : " . $personnage->getPv() . "\n";
    } else {
        echo "Vous avez réussi à esquiver le piège`\n";
    }
}

function marchander($personnage, $gestionDAO){
    popen('cls', 'w');
    echo "Vous entrez dans la boutique du marchand. \nIl vous propose de troquer des objets. \n\nSes objets en vente sont : \n\n";
    $gestionDAO['objetDAO']->getObjets();
    $marchand = [];
    for($i = 0; $i < 4; $i++){
        $random = rand(0, count($gestionDAO['objetDAO']->getObjets()));
        $objet = $gestionDAO['objetDAO']->getObjet($random);
        array_push($marchand, $objet);
        echo $objet['nom'] . " - " . $objet['desc'] . "\n";
    }
    for ($i=0; $i < 2; $i++) { 
        $objet = creationObjet($gestionDAO);
        array_push($marchand, $objet);
        echo $objet['nom'] . " - " . $objet['desc'] . "\n";
    }
    
    echo "\n\nVos objets sont : \n\n";
    $gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId());
    foreach($gestionDAO['porterDAO']->getPorter() as $key => $porter){
        $objet = $gestionDAO['objetDAO']->getObjet($porter['idObj']);
        echo $key+1 . " - " . $objet['nom'] . " - " . $objet['desc'] . "\n";
    }

    echo "\n\nQue souhaitez-vous faire ?\n\n
        1 - Echanger un objet\n
        2 - Continuer votre route\n\n";

    $choix = (int)readline('Votre choix : ');
    if($choix < 1 || $choix > 2){
        marchander($personnage,$gestionDAO);
    }
    
    switch($choix){
        case 1 :
            echangerObjet($personnage,$marchand,$gestionDAO);
            break;
        case 2 :
            menuJoueur($gestionDAO, $personnage);
            break;
    }
}

function creationObjet($gestionDAO){
    $type = random(0,13);
    $heal = 0;
    $atk = 0;
    $def = 0;
    $dodge = 0;
    $isConsumable = 0;

    if($type <=3){
        $caracteristique = random(0,3);
        if($caracteristique == 0){
            $nom = "Potion de soin";
            $stat = random(1,5);
            $heal = $stat * 10;
            $desc = "Soigne de " . $heal . " PV";
        }else if($caracteristique == 1){
            $nom = "Potion d'attaque";
            $stat = random(1,5);
            $atk = $stat * 2;
            $desc = "Augmente l'attaque de " . $atk;
        }else if($caracteristique == 2){
            $nom = "Potion de défense";
            $stat = random(1,5);
            $def = $stat * 2;
            $desc = "Augmente la défense de " . $def;
        }else if($caracteristique == 3){
            $nom = "Potion d'esquive";
            $dodge = 1;
            $desc = "Augmente l'esquive";
        }
        $isConsumable = 1;
    }else if($type >3 && $type <=6){
        $caracteristique = random(0,2);
        $stat = random(1,5);
        if($caracteristique == 0){
            $nom = "Épée";
            $atk = $stat * 2;
            $desc = "Augmente l'attaque de " . $atk;
        }else if($caracteristique == 1){
            $nom = "Hache";
            $atk = $stat * 3;
            $desc = "Augmente l'attaque de " . $atk;
        }else if($caracteristique == 2){
            $nom = "Dague";
            $atk = $stat * 1;
            $desc = "Augmente l'attaque de " . $atk;
        }
        $stat = random(1,5);
        if($stat == 1) {
            $def = -5;
            $desc = "Augmente l'attaque de " . $atk . " - Maudit";
        }else if($stat == 2) {
            $heal = -10;
            $desc = "Augmente l'attaque de " . $atk . " - Maudit";
        }
    }else if ($type >6 && $type <= 9){
        $caracteristique = random(0,2);
            if($caracteristique == 0){
                $nom = "Bouclier";
                $stat = random(1,5);
                $def = $stat * 2;
                $desc = "Augmente la défense de " . $def;
            }else if($caracteristique == 1){
                $nom = "Armure";
                $stat = random(1,5);
                $def = $stat * 3;
                $desc = "Augmente la défense de " . $def;
            }else if($caracteristique == 2){
                $nom = "Casque";
                $stat = random(1,5);
                $def = $stat * 1;
                $desc = "Augmente la défense de " . $def;
            }
            $stat = random(1,5);
            if($stat == 1) {
                $atk = -5;
                $desc = "Augmente la défense de " . $def . " - Maudit";
            }else if($stat == 2) {
                $heal = -10;
                $desc = "Augmente la défense de " . $def . " - Maudit";
            }
    }else if ($type == 9 || $type == 10){
        $caracteristique = random(0,1);
            if($caracteristique == 0){
                $nom = "Anneau";
                $stat = random(1,5);
                $dodge = 1;
                $desc = "Augmente l'esquive";
            }else if($caracteristique == 1){
                $nom = "Amulette";
                $stat = random(1,5);
                $dodge = 1;
                $desc = "Augmente l'esquive et la vie maximale de " . $stat * 10 . " PV";
            }
            $stat = random(1,5);
            if($stat == 1) {
                $atk = -5;
                $desc = "Augmente l'esquive de " . $dodge . " - Maudit";
            }else if($stat == 2) {
                $heal = -10;
                $desc = "Augmente l'esquive de " . $dodge . " - Maudit";
            }
    }else{
        $caracteristique = random(0,4);
        if($caracteristique == 0){
            $nom = "Hache de guerre légendaire";
            $stat = random(5,8);
            $atk = $stat * 5;
            $desc = "Augmente l'attaque de " . $atk;
        }else if($caracteristique == 1){
            $nom = "Armure légendaire";
            $stat = random(3,5);
            $def = $stat * 5;
            $desc = "Augmente la défense de " . $def;
        }else if($caracteristique == 2){
            $nom = "Anneau de défense légendaire";
            $stat = random(2,3);
            $dodge = $stat * 5;
            $desc = "Augmente l'esquive";
        }else if($caracteristique == 3){
            $nom = "Amulette légendaire";
            $stat = random(5,8);
            $dodge = 1;
            $desc = "Augmente l'esquive et la vie maximale de " . $stat * 10 . " PV";
        }else if($caracteristique == 4){
            $nom = "Potion légendaire";
            $stat = random(1,3);
            $heal = $stat * 50;
            $isConsumable = 1;
            $desc = "Soigne de " . $heal . " PV";
        }
    }

    $objet = new Objet($nom, $desc, $heal, $atk, $def, $dodge, $isConsumable);
    $gestionDAO['objetDAO']->addObjet($objet);
    $id = $gestionDAO['objetDAO']->getLastObjetId();
    $objet = $gestionDAO['objetDAO']->getObjet($id);
    return $objet;
}

function echangerObjet($personnage,$marchand,$gestionDAO ){
    popen('cls', 'w');
    echo "Quel objet souhaitez-vous échanger ?\n\n";
    $gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId());
    foreach($gestionDAO['porterDAO']->getPorter() as $key => $porter){
        $objet = $gestionDAO['objetDAO']->getObjet($porter['idObj']);
        echo $key+1 . " - " . $objet['nom'] . "€\n";
    }
    echo $key+2 . " - Retour\n\n";
    
    $choix = (int)readline('Numéro de l\'objet que vous souhaitez échanger : ');
    if($choix < 1 || $choix > count($gestionDAO['porterDAO']->getPorter())+1){
        echangerObjet($personnage,$marchand );
    }

    if ($choix == count($gestionDAO['porterDAO']->getPorter())+1) {
        marchander($personnage);
    }

    $monObjet = $gestionDAO['objetDAO']->getObjet($gestionDAO['porterDAO']->getPorter()[$choix-1]['idObj']);
    $monObjetId = $gestionDAO['porterDAO']->getPorter()[$choix-1]['id'];

    popen('cls', 'w');
    echo "Quel objet souhaitez-vous prendre ?\n\n";
    foreach($marchand as $key => $objet){
        echo $key+1 . " - " . $objet['nom'] . "€\n";
    }
    echo $key+2 . " - Retour\n\n";

    $choix = (int)readline('Numéro de l\'objet que vous souhaitez prendre : ');
    if($choix < 1 || $choix > count($marchand)+1){
        echangerObjet($personnage,$marchand );
    }

    if ($choix == count($marchand)+1) {
        marchander($personnage,$gestionDAO);
    }

    $objet = $gestionDAO['objetDAO']->getObjet($marchand[$choix-1]['idObj']);

    $gestionDAO['porterDAO']->deletePorter($monObjetId);
    $porter = new Porter($personnage->getId(), $objet['id']);
    $gestionDAO['porterDAO']->addPorter($porter);   
    marchander($personnage,$gestionDAO);
}


// COMBAT SALLE
function attaquePerso($gestionDAO){
    $personnage = $gestionDAO['personnageDAO']->getPersonnage(1);
    $monstre = $gestionDAO['monstreDAO']->getMonstre(1);
    $isDefendingMonstre = rand(1, 2);
    if ($isDefendingMonstre == 1){
        $monstre->setDef($monstre->getDef() - $personnage->getAtk());
        $gestionDAO['monstreDAO']->updateMonstre(1, $monstre);
        echo "Le personnage a subi une attaque. Nouvelle valeur de défense : {$personnage->getDef()}\n";
    } else {
        $monstre->setPv($monstre->getPv() - $personnage->getAtk());
        $gestionDAO['monstreDAO']->updateMonstre(1, $monstre);
        echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
    }
}
function defensePerso($gestionDAO) {
    $personnage = $gestionDAO['personnageDAO']->getPersonnage(1);
    $monstre = $gestionDAO['monstreDAO']->getMonstre(1);
    
    if ($personnage->getDef() == 0) {
        echo "Le personnage n'a plus de défense. ";
        $personnage->setPv($personnage->getPv() - $monstre->getAtk());
        $gestionDAO['personnageDAO']->updatePersonnage(1, $personnage);
        echo "Le monstre a attaqué le personnage, il lui reste " . $personnage->getPv() . " points de vie." ;
    } else {
        $personnage->setDef($personnage->getDef() - $monstre->getAtk());
        $gestionDAO['personnageDAO']->updatePersonnage(1, $personnage);
        echo "Le personnage a subi une attaque. Nouvelle valeur de défense : {$personnage->getDef()}\n";
    }
}

function attaqueMonstre($gestionDAO){
    $personnage = $gestionDAO['personnageDAO']->getPersonnage(1);
    $monstre = $gestionDAO['monstreDAO']->getMonstre(1);

    if ($personnage->getIsDefending()) {
        $personnage->stopDefending();
        $personnage->setDef($personnage->getDef() - $monstre->getAtk());
        $gestionDAO['personnageDAO']->updatePersonnage(1, $personnage);
        echo "Le personnage a subi une attaque en se défendant. voici la valeur de votre défense : " . $personnage->getDef() . "\n";
    } else {
        $personnage->setPv($personnage->getPv() - $monstre->getAtk());
        $gestionDAO['personnageDAO']->updatePersonnage(1, $personnage);
        echo "Le monstre a attaqué le personnage, il lui reste " . $personnage->getPv() . " points de vie." ;
    }
    

}

function defensemonstre($gestionDAO){
    $personnage = $gestionDAO['personnageDAO']->getPersonnage(1);
    $monstre = $gestionDAO['monstreDAO']->getMonstre(1);
    if ($monstre->getDef() <= 0) {
        echo "Le monstre n'a plus de défense. ";
        $monstre->setPv($monstre->getPv() - $personnage->getAtk());
        $gestionDAO['monstreDAO']->updateMonstre(1, $monstre);
        echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
    } else {
        $monstre->setDef($monstre->getDef() - $personnage->getAtk());
        $gestionDAO['monstreDAO']->updatePersonnage(1, $monstre);
        echo "Le monstre a une attaque. Nouvelle valeur de défense : {$monstre->getDef()}\n";

    }
}
function potion($gestionDAO){
    $personnage = $gestionDAO['personnageDAO']->getPersonnage(1);
    $objet = $gestionDAO['objetDAO']->getMonstre(1);
    $personnage->setPv($personnage->getPv() + 10);
    $gestionDAO['personnageDAO']->updatePersonnage(1, $personnage);
    echo "Le personnage a bu une potion, il lui reste " . $personnage->getPv() . " points de vie." ;
}
// function mourir($gestionDAO['personnageDAO'], $gestionDAO['monstreDAO']){
//     $personnage = $gestionDAO['personnageDAO']->getPersonnage(1);
//     $monstre = $gestionDAO['monstreDAO']->getMonstre(1);
//     if ($personnage->getPv() <= 0){
//         echo "Le personnage est mort, il a perdu la partie.";
//     }
//     if ($monstre->getPv() <= 0){
//         echo "Le monstre est mort, le personnage a gagné la partie.";
//     }
// }

function combat($gestionDAO, $listeMonstres){
    $personnage = $gestionDAO['personnageDAO']->getPersonnage(1);
    echo "Un monstre vous attaque !";
        while ($personnage->getPv() > 0 && count($listeMonstres) > 0){
            echo "Que voulez-vous faire ?\n";
            echo "1. Attaquer\n";
            echo "2. Se défendre\n";
            echo "3. Se soigner\n";
            $choix = readline("Votre choix : ");
            switch ($choix) {
                case 1:
                    attaquePerso($gestionDAO);
                    for($i=0; $i<count($listeMonstres); $i++){
                        $ennemiechoice = rand(1, 2);
                        if ($ennemiechoice == 1){
                            attaqueMonstre($gestionDAO);
    
                        } else {
                            defensemonstre($gestionDAO);
                        }
                    }
                    
                    break;
                case 2:
                    // defensePerso($gestionDAO);
                    $personnage->startDefending();
                    attaqueMonstre($gestionDAO);
                    break;
                case 3:
                    potion($gestionDAO);
                    attaqueMonstre($gestionDAO);
                    break;
                default:
                    echo "Choix invalide\n";

                    break;
            }
        } if ($personnage->getPv() <= 0){
            echo "Le personnage est mort, il a perdu la partie.";
        }elseif ($monstre->getPv() <= 0){
            echo "Le monstre est mort, le personnage a gagné la partie.";
            takeExp($personnage , $monstre, $gestionDAO);
        }
}

function takeExp($personnage , $monstre, $gestionDAO){
    $exp = $personnage->getExp();
    $exp += $monstre->getExp();
    $personnage->setExp($personnage->getExp() + $exp);
    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
}

// FIN DE PARTIE
function victoireJoueur($personnage){
    popen('cls', 'w');
    if($personnage->getLevel() >= 10){
        echo "Vous avez gagné la partie !";
    }
    else{
        echo "Vous avez gagné le combat !";
    }
}

function missionAccomplie($personnage){
    popen('cls', 'w');
    echo "Vous avez gagné la partie !";
}

function mortJoueur($personnage){
    popen('cls', 'w');
    echo "Vous avez perdu la partie !";
}

// FERMER LE JEU
function exitGame(){
    exit;
}

menu($gestionDAO);

?>