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

// instanciation des DAO
$personnageDAO = new PersonnageDAO($db);
$monstreDAO = new MonstreDAO($db);
$salleDAO = new SalleDAO($db);
$porterDAO = new PorterDAO($db);
$objetDAO = new ObjetDAO($db);
$enigmeDAO = new EnigmeDAO($db);


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
// $personnageDAO->addPersonnage($personnage);

// $monstre = new Monstre('Gobelin',10, 10, 'Attaque de base', 5, 10);
// $monstreDAO->addMonstre($monstre);


// MENU DEBUT DE JEU
function menu($personnageDAO){
    popen('cls','w');
    echo "Bienvenue Joueur";
    echo "Veux-tu : \n 1 - Charger une nouvelle partie \n2 - Charger une partie déjà créée \n3 - Quitter";
    $choice = readline("");
    switch ($choice) {
        case '1':
            $personnage = createPersonnage($personnageDAO);
            menuJoueur($personnageDAO, $personnage);
            break;
        case '2':
            $personnage = chargerPartie();
            menuJoueur($personnageDAO, $personnage);
            break;
        case '3':
            exitGame();
            break;
        default:
            menu($personnageDAO)
            exit;
    }
}

// CREER UN PERSONNAGE
function createPersonnage($personnageDAO){
    popen('cls','w');
    $nom = readline(("Quel est le nom de votre personnage ?"));
    $personnage = new Personnage($nom);
    var_dump($personnage);
    $personnageDAO->addPersonnage($personnage);
    $id = $personnageDAO->getLastPersonnageId();
    $personnage->setId($id);
    return $personnage;
}

// CHARGER UNE PARTIE
function chargerPartie(){
    popen('cls','w');
    $personnageDAO->getPersonnages();
    echo "Choisir une partie :\n";
    foreach ($personnageDAO->getPersonnages() as $key => $personnage) {
        echo $key+1 . ' - ' . $personnage['name'] . " - Niveau: " . $personnage['level'] . "\n";
    }
    echo "Quel est le numéro de votre partie ?";
    $choix = readline("");
    $personnage = $personnageDAO->getPersonnage($choix);

    popen('cls','w');
    echo "Vous avez choisi la partie de " . $personnage['name'] . "\n";
    readline("Appuyer sur entrer pour continuer");
    return $personnage;
}


// MENU PERSONNAGE 
function menuJoueur($personnageDAO, $personnage){
    // stat, inventaire, avancer salle, quitter
    updatePerso($personnage)
    popen('cls','w');
    echo ("Que souhaitez-vous faire ? \n1-Voir vos stats \n2-voir son inventaire \n3-avancer à la prochaine salle \n4-quitter");
    $choice = readline("");
    switch ($choice) {
        case '1':
            afficherPersonnage($personnage);
            break;
        case '2':
            voirInventaire();
            break;
        case '3':
            avancerSalle();
            break;
        case '4';
            exitGame();
            break;
        default:
            menuJoueur($personnageDAO, $personnage);
            break;
    }
    
}

// STATS PERSONNAGES ET OBJETS
function afficherPersonnage($personnage){
    updatePerso($personnage)
    popen('cls', 'w');
    echo 'Nom : ' . $personnage->getName() . '<br>';
    echo 'PV : ' . $personnage->getPv() . '<br>';
    echo 'Attaque : ' . $personnage->getAtk() . '<br>';
    echo 'Défense : ' . $personnage->getDef() . '<br>';
    echo 'Expérience : ' . $personnage->getExp() . '<br>';
    echo 'Niveau : ' . $personnage->getLevel() . '<br>';
    readline("Appuyer sur entrer pour continuer");
}

function voirInventaire($personnage){
    popen('cls', 'w');
    echo "Vos objets sont : \n\n";
    $porterDAO->getPorterByPersonnage($personnage->getId());
    foreach($porterDAO->getPorter() as $key => $porter){
        $objet = $objetDAO->getObjet($porter['idObj']);
        echo $key+1 . " - " . $objet['nom'] . " - " . $objet['desc'] . "\n";
    }
    echo "\n\nQue souhaitez-vous faire ?\n\n
        1 - Jeter un objet\n
        2- Retour\n\n";
    $choix = (INT)readline("Entrez votre choix : ");
    if($choix < 1 || $choix > 2){
        voirInventaire($personnage);
    }
    switch($choix){
        case 1 :
            jeterObjet($personnage);
            break;
        case 2 :
            menuJoueur($personnageDAO, $personnage);
            break;
    }
}

function jeterObjet($personnage){
    popen('cls', 'w');
    echo "Quel objet souhaitez-vous jeter ?\n\n";
    $porterDAO->getPorterByPersonnage($personnage->getId());
    foreach($porterDAO->getPorter() as $key => $porter){
        $objet = $objetDAO->getObjet($porter['idObj']);
        echo $key+1 . " - " . $objet['nom'] . " - " . $objet['desc'] . "\n";
    }
    echo $key+2 . " - Retour\n\n";
    
    $choix = (int)readline('Numéro de l\'objet que vous souhaitez jeter : ');
    if($choix < 1 || $choix > count($porterDAO->getPorter())+1){
        jeterObjet($personnage);
    }

    if ($choix == count($porterDAO->getPorter())+1) {
        voirInventaire($personnage);
    }

    $objet = $objetDAO->getObjet($porterDAO->getPorter()[$choix-1]['idObj']);
    $porterDAO->deletePorter($porterDAO->getPorter()[$choix-1]['id']);
    echo "Vous avez jeté l'objet " . $objet['nom'] . "\n\n";
    readline("Appuyer sur entrer pour continuer");
    voirInventaire($personnage);
}


// LEVEL-UP ET MAJ STATS

function updatePerso($personnage){
    $personnage->setPv($personnage->getMaxpv());
    $personnage->setDef($personnage->getMaxdef());
    $personnage->setAtk($personnage->getMaxatk());
    $personnage->setDodge(0);
    $personnageDAO->updatePersonnage($personnage->getId(), $personnage);

    $porterDAO->getPorterByPersonnage($personnage->getId());
    foreach($porterDAO->getPorter() as $key => $porter){
        $objet = $objetDAO->getObjet($porter['idObj']);
        $personnage->setPv($personnage->getPv() + $objet['heal']);
        $personnage->setAtk($personnage->getAtk() + $objet['atk']);
        $personnage->setDef($personnage->getDef() + $objet['def']);
        $personnage->setDodge($personnage->getDodge() + $objet['dodge']);
    }
    $personnageDAO->updatePersonnage($personnage->getId(), $personnage);
}

function levelUp($personnage){
    if($personnage->getExp() < $personnage->getLevel()*200){
        echo "Vous n'avez pas assez d'expérience pour gagner un niveau !\n";
        readline("Appuyer sur entrer pour continuer");
        menuJoueur($personnageDAO, $personnage);
    }
    $personnage->setLevel($personnage->getLevel() + 1);
    $personnage->setExp(0);
    $personnage->setMaxpv($personnage->getMaxpv() + 10);
    $personnage->setMaxdef($personnage->getMaxdef() + 5);
    $personnage->setMaxatk($personnage->getMaxatk() + 5);
    $personnageDAO->updatePersonnage($personnage->getId(), $personnage);
    updatePerso($personnage);
    echo "Vous avez gagné un niveau !\n";
    readline("Appuyer sur entrer pour continuer");
    menuJoueur($personnageDAO, $personnage);
}


// ACTION SALLE

function avancerSalle($personnage){
    popen('cls', 'w');

    echo "Vous avancez vers la salle";
    $niveau = $personnage->getLevel();
    // à  changer pour les stats (augmenter ennemis, réduire marchands, etc.)
    $ennemie = rand(1,5);
    $piege = rand(0,1);
    $enigme = rand(0,1);
    $marchand = rand(0,1);
    
    $salle = new Salle($niveau, $ennemie, $piege, $enigme, $marchand);
    $SalleDAO->getSalle($salle);

    readline("Appuyer sur entrer pour continuer");

    if($salle->getEnigme() > 0){
        doEnigme();
    }

    if($salle->getPiege() > 0){
        activerPiege();
    }
    if($salle->getEnnemie() > 0){
        $listeMonstres = [];
        $monstres = showMonstre($monstreDAO, $personnageDAO, $personnage);
        for($i; $i<$salle->getEnnemie(); $i++){
            $random = rand(0, count($monstres));
            $monstre = $monstreArray[$i];
            array_push($listeMonstres, $monstre)
        }

        combatSalle($personnage, $listeMonstres);
    }
    if($salle->getMarchand() > 0){
        marchander($personnage, $objetDAO);
    }
    menuJoueur($personnageDAO, $personnage);
}

function showMonstre($monstreDAO, $personnageDAO, $personnage){
    $monstres = $monstreDAO->getAllMonstre();
    $niveau = $personnageDAO->getPersonnageNiveau($personnage);
    $monstreArray = [];
    
    foreach ($monstres as $monstre) {
        if($monstre['exp'] <= 100 * $niveau){
            array_push($monstreArray, $monstre);
        }
    }
    return $monstreArray;
}

function doEnigme($personnage, $enigmeDAO) {
    popen('cls', 'w');
    echo "Vous entrez dans la salle et voyez une énigme. \n\n";
    $random = rand(1, count($enigmeDAO->getEnigmes()));
    $enigme = $enigmeDAO->getEnigme($random);
    echo $enigme['intitule'] . "\n\n";
    $reponse = readline("Votre réponse : ");
    if(strtolower($reponse) == strtolower($enigme['reponse'])){
        echo "Bonne réponse !\n\n";
        $personnage->setExp($personnage->getExp() + 100);
        $personnage->setPv($personnage->getPv() + 10);
        $personnageDAO->updatePersonnage($personnage->getId(), $personnage);
        readline("Appuyer sur entrer pour continuer");
    }
    else{
        echo "Mauvaise réponse !\n\n";
        readline("Appuyer sur entrer pour continuer");
    }
}

function ouvrirCoffre($personnage){
    popen('cls', 'w');
    // choix ouvrir coffre ou non
    $isMimic = rand(0,10);
    $choix = (int)readline("Voulez-vous ouvrir le coffre ?\n1 - Oui\n2 - Non\n\nVotre choix : ");
    if($choix < 1 || $choix > 2){
        ouvrirCoffre($personnage);
    }
    if($choix == 1){
        if($isMimic == 10){
            echo "Le coffre était un Mimic !\n\nVous perdez " . $personnage->getNiveau() * 10 . "PV\n\n";
            $personnage->setPv($personnage->getPv() = $personnage->getNiveau() * 10);
            readline("Appuyer sur entrer pour continuer");
        }else{
            echo "Le coffre contient : \n\n";
            $objetDAO->getObjets();
            $marchand = [];
            for($i = 0; $i < 4; $i++){
                $random = rand(0, count($objetDAO->getObjets()));
                $objet = $objetDAO->getObjet($random);
                array_push($marchand, $objet);
                echo $objet['nom'] . " - " . $objet['desc'] . "\n";
            }
            for ($i=0; $i < 2; $i++) { 
                $objet = creationObjet($objetDAO);
                array_push($marchand, $objet);
                echo $objet['nom'] . " - " . $objet['desc'] . "\n";
            }
        }
    }else{
        menuJoueur($personnageDAO, $personnage);
    }
}

function activerPiege($personnageDAO, $personnage){
    popen('cls', 'w');
    
    $dodge = $personnageDAO->getDodge();
    echo "Vous avez activez un piège.";
    if($dodge == 0){
        $personnage->setPv($personnage->getPv() = $personnage->getNiveau() * 10);
        echo "Vous n'avez pas réussi a dodge le piège.\n";
        echo "Vous perdez 10% de point de vie, il vous reste : " . $personnage->getPv() . "\n";
    } else {
        echo "Vous avez réussi a dodge le piège`\n";
    }
}

function marchander($personnage, $objetDAO){
    popen('cls', 'w');
    echo "Vous entrez dans la boutique du marchand. \nIl vous propose de troquer des objets. \n\nSes objets en vente sont : \n\n";
    $objetDAO->getObjets();
    $marchand = [];
    for($i = 0; $i < 4; $i++){
        $random = rand(0, count($objetDAO->getObjets()));
        $objet = $objetDAO->getObjet($random);
        array_push($marchand, $objet);
        echo $objet['nom'] . " - " . $objet['desc'] . "\n";
    }
    for ($i=0; $i < 2; $i++) { 
        $objet = creationObjet($objetDAO);
        array_push($marchand, $objet);
        echo $objet['nom'] . " - " . $objet['desc'] . "\n";
    }
    
    echo "\n\nVos objets sont : \n\n";
    $porterDAO->getPorterByPersonnage($personnage->getId());
    foreach($porterDAO->getPorter() as $key => $porter){
        $objet = $objetDAO->getObjet($porter['idObj']);
        echo $key+1 . " - " . $objet['nom'] . " - " . $objet['desc'] . "\n";
    }

    echo "\n\nQue souhaitez-vous faire ?\n\n
        1 - Echanger un objet\n
        2 - Continuer votre route\n\n";

    $choix = (int)readline('Votre choix : ');
    if($choix < 1 || $choix > 2){
        marchander($personnage);
    }
    
    switch($choix){
        case 1 :
            echangerObjet($personnage,$marchand );
            break;
        case 2 :
            menu($personnage);
            break;
    }
}

function creationObjet($objetDAO){
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
    $objetDAO->addObjet($objet);
    $id = $objetDAO->getLastObjetId();
    $objet = $objetDAO->getObjet($id);
    return $objet;
}

function echangerObjet($personnage,$marchand ){
    popen('cls', 'w');
    echo "Quel objet souhaitez-vous échanger ?\n\n";
    $porterDAO->getPorterByPersonnage($personnage->getId());
    foreach($porterDAO->getPorter() as $key => $porter){
        $objet = $objetDAO->getObjet($porter['idObj']);
        echo $key+1 . " - " . $objet['nom'] . "€\n";
    }
    echo $key+2 . " - Retour\n\n";
    
    $choix = (int)readline('Numéro de l\'objet que vous souhaitez échanger : ');
    if($choix < 1 || $choix > count($porterDAO->getPorter())+1){
        echangerObjet($personnage,$marchand );
    }

    if ($choix == count($porterDAO->getPorter())+1) {
        marchander($personnage);
    }

    $monObjet = $objetDAO->getObjet($porterDAO->getPorter()[$choix-1]['idObj']);
    $monObjetId = $porterDAO->getPorter()[$choix-1]['id'];

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
        marchander($personnage);
    }

    $objet = $objetDAO->getObjet($marchand[$choix-1]['idObj']);

    $porterDAO->deletePorter($monObjetId);
    $porter = new Porter($personnage->getId(), $objet['id']);
    $porterDAO->addPorter($porter);   
    marchander($personnage);
}


// COMBAT SALLE
function attaquePerso($personnageDAO, $monstreDAO){
    $personnage = $personnageDAO->getPersonnage(1);
    $monstre = $monstreDAO->getMonstre(1);
    $isDefendingMonstre = rand(1, 2);
    if ($isDefendingMonstre == 1){
        $monstre->setDef($monstre->getDef() - $personnage->getAtk());
        $monstreDAO->updateMonstre(1, $monstre);
        echo "Le personnage a subi une attaque. Nouvelle valeur de défense : {$personnage->getDef()}\n";
    } else {
        $monstre->setPv($monstre->getPv() - $personnage->getAtk());
        $monstreDAO->updateMonstre(1, $monstre);
        echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
    }
}
function defensePerso($personnageDAO, $monstreDAO) {
    $personnage = $personnageDAO->getPersonnage(1);
    $monstre = $monstreDAO->getMonstre(1);
    
    if ($personnage->getDef() == 0) {
        echo "Le personnage n'a plus de défense. ";
        $personnage->setPv($personnage->getPv() - $monstre->getAtk());
        $personnageDAO->updatePersonnage(1, $personnage);
        echo "Le monstre a attaqué le personnage, il lui reste " . $personnage->getPv() . " points de vie." ;
    } else {
        $personnage->setDef($personnage->getDef() - $monstre->getAtk());
        $personnageDAO->updatePersonnage(1, $personnage);
        echo "Le personnage a subi une attaque. Nouvelle valeur de défense : {$personnage->getDef()}\n";
    }
}

function attaqueMonstre($personnageDAO, $monstreDAO){

    $personnage = $personnageDAO->getPersonnage(1);
    $monstre = $monstreDAO->getMonstre(1);
    $personnage->setPv($personnage->getPv() - $monstre->getAtk());
    $personnageDAO->updatePersonnage(1, $personnage);
    echo "Le monstre a attaqué le personnage, il lui reste " . $personnage->getPv() . " points de vie." ;
}

function defensemonstre($personnageDAO, $monstreDAO){
    $personnage = $personnageDAO->getPersonnage(1);
    $monstre = $monstreDAO->getMonstre(1);
    if ($monstre->getDef() <= 0) {
        echo "Le monstre n'a plus de défense. ";
        $monstre->setPv($monstre->getPv() - $personnage->getAtk());
        $monstreDAO->updateMonstre(1, $monstre);
        echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
    } else {
        $monstre->setDef($monstre->getDef() - $personnage->getAtk());
        $monstreDAO->updatePersonnage(1, $monstre);
        echo "Le monstre a une attaque. Nouvelle valeur de défense : {$monstre->getDef()}\n";

    }
}
function potion($personnageDAO, $objetDAO){
    $personnage = $personnageDAO->getPersonnage(1);
    $objet = $objetDAO->getMonstre(1);
    $personnage->setPv($personnage->getPv() + 10);
    $personnageDAO->updatePersonnage(1, $personnage);
    echo "Le personnage a bu une potion, il lui reste " . $personnage->getPv() . " points de vie." ;
}
// function mourir($personnageDAO, $monstreDAO){
//     $personnage = $personnageDAO->getPersonnage(1);
//     $monstre = $monstreDAO->getMonstre(1);
//     if ($personnage->getPv() <= 0){
//         echo "Le personnage est mort, il a perdu la partie.";
//     }
//     if ($monstre->getPv() <= 0){
//         echo "Le monstre est mort, le personnage a gagné la partie.";
//     }
// }

function combat($personnageDAO, $listeMonstres){
    $personnage = $personnageDAO->getPersonnage(1);
    echo "Un monstre vous attaque !";
        while ($personnage->getPv() > 0 && count($listeMonstres) > 0){
            echo "Que voulez-vous faire ?\n";
            echo "1. Attaquer\n";
            echo "2. Se défendre\n";
            $choix = readline("Votre choix : ");
            switch ($choix) {
                case 1:
                    attaquePerso($personnageDAO, $monstreDAO);
                    for($i=0; $i<count($listeMonstres); $i++){
                        $ennemiechoice = rand(1, 2);
                        if ($ennemiechoice == 1){
                            attaqueMonstre($personnageDAO, $monstreDAO);
    
                        } else {
                            defensemonstre($personnageDAO, $monstreDAO);
                        }
                    }
                    
                    break;
                case 2:
                    defensePerso($personnageDAO, $monstreDAO);
                    attaqueMonstre($personnageDAO, $monstreDAO);
                    break;
                case 3:
                    potion($personnageDAO, $objetDAO);
                    attaqueMonstre($personnageDAO, $monstreDAO);
                    break;
                default:
                    echo "Choix invalide\n";

                    break;
            }
        } if ($personnage->getPv() <= 0){
            echo "Le personnage est mort, il a perdu la partie.";
        }elseif ($monstre->getPv() <= 0){
            echo "Le monstre est mort, le personnage a gagné la partie.";
            takeExp();
        }
}

function takeExp($personnage , $monstre){
    $exp = $personnage->getExp();
    $exp += $monstre->getExp();
    $personnage->setExp($personnage->getExp() + $exp);
    $personnageDAO->updatePersonnage($personnage->getId(), $personnage);
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
?>