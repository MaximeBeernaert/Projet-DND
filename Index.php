<?php
// connexion à la base de données
include_once('./Config.php');

// inclusion des classes
include_once('./Classes/Personnage.php');
include_once('./Classes/Monstre.php');
include_once('./Classes/Salle.php');
include_once('./Classes/Porter.php');
include_once('./Classes/Objet.php');
include_once('./Classes/Enigme.php');
include_once('./Classes/Competence.php');
include_once('./Classes/Utiliser.php');

// inclusion des DAO
include_once ('./DAO/PersonnageDAO.php');
include_once ('./DAO/MonstreDAO.php');
include_once ('./DAO/PorterDAO.php');
include_once ('./DAO/ObjetDAO.php');
include_once ('./DAO/EnigmeDAO.php');
include_once ('./DAO/CompetenceDAO.php');
include_once ('./DAO/UtiliserDAO.php');

// instanciation des DAO
$personnageDAO = new PersonnageDAO($db);
$monstreDAO = new MonstreDAO($db);
$porterDAO = new PorterDAO($db);
$objetDAO = new ObjetDAO($db);
$enigmeDAO = new EnigmeDAO($db);
$competenceDAO = new CompetenceDAO($db);
$utiliserDAO = new UtiliserDAO($db);
$gestionDAO = array('personnageDAO' => $personnageDAO, 
                    'monstreDAO' => $monstreDAO, 
                    'porterDAO' => $porterDAO, 
                    'objetDAO' => $objetDAO, 
                    'enigmeDAO' => $enigmeDAO, 
                    'competenceDAO' => $competenceDAO, 
                    'utiliserDAO' => $utiliserDAO);


// $monstre = new Monstre("Dragon", 100, 20, "Souffle de feu", 10, 500);
// $monstreDAO->addMonstre($monstre);
// $monstre2 = new Monstre("Gobelin", 10, 5, "Attaque de base", 5, 100);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Ogre", 120, 25, "Frappe puissante", 15, 600);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Spectre", 80, 15, "Toucher glacial", 8, 300);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Banshee", 90, 18, "Cri perçant", 12, 400);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Loup-garou", 110, 22, "Morsure féroce", 12, 550);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Chimère", 150, 30, "Rugissement dévastateur", 20, 700);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Hydre", 180, 35, "Morsure venimeuse", 25, 800);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Orc", 80, 12, "Frappe brutale", 10, 300);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Elemental", 200, 40, "Furie élémentaire", 30, 1000);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Golem", 250, 45, "Frappe de pierre", 35, 1200);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Géant", 300, 50, "Frappe dévastatrice", 40, 1500);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Squelette", 50, 8, "Attaque de base", 5, 200);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Zombie", 60, 10, "Morsure infectée", 8, 250);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Vampire", 70, 12, "Morsure vampirique", 10, 300);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Liche", 100, 15, "Toucher glacial", 12, 400);
// $monstreDAO->addMonstre($monstre);
// $monstre = new Monstre("Démon", 150, 20, "Frappe démoniaque", 15, 600);
// $monstreDAO->addMonstre($monstre);

// $enigme = new Enigme("Qu'est-ce qui est jaune et qui attend ?", "Jonathan");
// $enigmeDAO->addEnigme($enigme);
// $enigme = new Enigme("Qu'est-ce qui est vert et qui attend ?", "Jonathan");
// $enigmeDAO->addEnigme($enigme);
// $enigme = new Enigme("Qu'est-ce qui est rouge et qui attend ?", "Jonathan");
// $enigmeDAO->addEnigme($enigme);
// $enigme = new Enigme("Qu'est-ce qui est bleu et qui attend ?", "Jonathan");
// $enigmeDAO->addEnigme($enigme);
// $enigme = new Enigme("Qu'est-ce qui est noir et qui attend ?", "Jonathan");
// $enigmeDAO->addEnigme($enigme);

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

    $personnage = new Personnage($tempPersonnage['nom'], $tempPersonnage['pv'], $tempPersonnage['atk'], $tempPersonnage['def'], $tempPersonnage['exp'], $tempPersonnage['level'], $tempPersonnage['maxpv'], $tempPersonnage['maxdef'], $tempPersonnage['maxatk']);
    $personnage->setId($tempPersonnage['id']);
    $personnage->setId($tempPersonnage['id']);
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
            avancerSalle($gestionDAO, $personnage);
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
    voirInventaire($gestionDAO, $personnage);
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
        if($objet['niveauMinimum'] > $personnage->getLevel()){
            echo "Vous n'avez pas le niveau requis pour utiliser l'objet " . $objet['nom'] . "\n\n";
            readline("Appuyer sur entrer pour continuer");
        }else{
            $personnage->setPv($personnage->getPv() + $objet['heal']);
            $personnage->setAtk($personnage->getAtk() + $objet['atk']);
            $personnage->setDef($personnage->getDef() + $objet['def']);
            $personnage->setDodge($personnage->getDodge() + $objet['dodge']);
        }
    }
    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
}

function levelUp($gestionDAO, $personnage){
    if($personnage->getExp() < $personnage->getLevel()*200){
        echo "Vous n'avez pas assez d'expérience pour gagner un niveau !\n";
        readline("Appuyer sur entrer pour continuer");
        menuJoueur($gestionDAO, $personnage);
    }
    $personnage->setLevel($personnage->getLevel() + 1);
    $personnage->setExp(0);
    $personnage->setMaxpv($personnage->getMaxpv() + 10);
    $personnage->setMaxdef($personnage->getMaxdef() + 5);
    $personnage->setMaxatk($personnage->getMaxatk() + 5);
    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
    updatePerso($personnage);
    echo "Vous avez gagné un niveau !\nVos stats ont été augmentées !\n\n";

    if($personnage->getLevel() == 3 ){
        echo "Vous pouvez choisir une nouvelle compétence ! \nChoisissez une compétence parmis les suivantes :\n";
        $competences = $gestionDAO['competenceDAO']->getCompetencesByNiveauMinimum(3);
        foreach($competences as $key => $competence){
            echo $key+1 . " - " . $competence['nom'] . " - " . $competence['desc'] . "\n";
        }
        $choix = (int)readline("Votre choix : ");


    }

    readline("Appuyer sur entrer pour continuer");
    menuJoueur($gestionDAO, $personnage);
}

function takeExp($gestionDAO, $personnage, $exp){
    $exp += $personnage->getExp();
    $personnage->setExp($personnage->getExp());
function takeExp($gestionDAO, $personnage, $exp){
    $exp += $personnage->getExp();
    $personnage->setExp($personnage->getExp());
    $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
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
    
    $salle = new Salle ($niveau, $ennemie, $piege, $enigme, $marchand);

    readline("Appuyer sur entrer pour continuer");

    if($salle->getEnigme() > 0){
        doEnigme($personnage, $gestionDAO);
    }

    if($salle->getPiege() > 0){
        activerPiege($gestionDAO, $personnage);
        activerPiege($gestionDAO, $personnage);
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

function showMonstre($gestionDAO, $personnage, $monstres){
    var_dump($gestionDAO);
    $monstres = $gestionDAO['monstreDAO']->getAllMonstre();
    var_dump($monstres);
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
        echo "Vous gagnez 10 PV et 100 exp.\n";
        echo "Vous gagnez 10 PV et 100 exp.\n";
        $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
        $tempPersonnage = $gestionDAO['personnageDAO']->getPersonnage($personnage->getId());
        $tempPersonnage = $gestionDAO['personnageDAO']->getPersonnage($personnage->getId());
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
                if(count($gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId())) >= 10){
                    echo "Vous n'avez pas assez de place dans votre inventaire !\nVeuillez retirer un objet\n\n";
                    readline();
                    jeterObjet($gestionDAO, $personnage);
                }
                $objet = $gestionDAO['objetDAO']->getObjet($marchand[$choix-1]['idObj']);
                $porter = new Porter($personnage->getId(), $objet['id']);
                $gestionDAO['porterDAO']->addPorter($porter);
                echo "Vous avez pris l'objet " . $objet['nom'] . "\n\n";
            }
            readline("");
        }
    }
}

function activerPiege($gestionDAO, $personnage){
    popen('cls', 'w');
    
    $dodge = $personnage->getDodge();
    echo "Vous avez activé un piège.";
    if($dodge == 0){
        $personnage->setPv($personnage->getPv() - $personnage->getLevel() * 10);
        echo "Vous n'avez pas réussi à esquiver le piège.\n";
        echo "Vous perdez ". ($personnage->getLevel() * 10) ." points de vie, il vous reste : " . $personnage->getPv() . "\n";
        $personnage->setPv($personnage->getPv() - $personnage->getLevel() * 10);
        echo "Vous n'avez pas réussi à esquiver le piège.\n";
        echo "Vous perdez ". ($personnage->getLevel() * 10) ." points de vie, il vous reste : " . $personnage->getPv() . "\n";
    } else {
        echo "Vous avez réussi à esquiver le piège`\n";
    }
    readline("Appuyer sur entrer pour continuer");
    readline("Appuyer sur entrer pour continuer");
}

function marchander($personnage, $gestionDAO){
    popen('cls', 'w');
    echo "Vous entrez dans la boutique du marchand. \nIl vous propose de troquer des objets. \n\nSes objets en vente sont : \n\n";
    $gestionDAO['objetDAO']->getObjets();
    $marchand = [];
    $echange = [];
    for($i = 0; $i < 4; $i++){
        $random = rand(0, count($gestionDAO['objetDAO']->getObjets()));
        $objet = $gestionDAO['objetDAO']->getObjet($random);
        array_push($marchand, $objet);
        echo $objet['nom'] . " - " . $objet['desc'] . " - Niveau requis : " . $objet['niveauMinimum'] . "\n";

        $randomEchange = rand(0, count($gestionDAO['objetDAO']->getObjets()));
        while ($random = $randomEchange || (
                    $gestionDAO['objetDAO']->getObjet($randomEchange)['nom'] == $gestionDAO['objetDAO']->getObjet($random)['nom'] &&
                    $gestionDAO['objetDAO']->getObjet($randomEchange)['heal'] == $gestionDAO['objetDAO']->getObjet($random)['heal'] &&
                    $gestionDAO['objetDAO']->getObjet($randomEchange)['atk'] == $gestionDAO['objetDAO']->getObjet($random)['atk'] &&
                    $gestionDAO['objetDAO']->getObjet($randomEchange)['def'] == $gestionDAO['objetDAO']->getObjet($random)['def'] &&
                    $gestionDAO['objetDAO']->getObjet($randomEchange)['dodge'] == $gestionDAO['objetDAO']->getObjet($random)['dodge'])){
            $randomEchange = rand(0, count($gestionDAO['objetDAO']->getObjets()));
        }
        $objetEchange = $gestionDAO['objetDAO']->getObjet($randomEchange);
        echo "Contre : " . $objetEchange['nom'] . " - " . $objetEchange['desc'] . " - Niveau requis : " . $objetEchange['niveauMinimum'] . "\n\n";
        array_push($echange, $objetEchange);
    }
    for ($i=0; $i < 2; $i++) { 
        $objet = creationObjet($gestionDAO);
        array_push($marchand, $objet);
        echo $objet['nom'] . " - " . $objet['desc'] . " - Niveau requis : " . $objet['niveauMinimum'] . "\n";

        $randomEchange = rand(0, count($gestionDAO['objetDAO']->getObjets()));
        while ($random = $randomEchange){
            $randomEchange = rand(0, count($gestionDAO['objetDAO']->getObjets()));
        }
        $objetEchange = $gestionDAO['objetDAO']->getObjet($randomEchange);
        echo "Contre : " . $objetEchange['nom'] . " - " . $objetEchange['desc'] . " - Niveau requis : " . $objetEchange['niveauMinimum'] . "\n\n";
        array_push($echange, $objetEchange);
    }
    
    echo "\n\nVous pouvez échanger : \n\n";
    $listeObjets = $gestionDAO['porterDAO']->getPorterByPersonnage($personnage->getId());
    $mesObjetsAEchanger = [];
    $index = 0;
    foreach($listeObjets as $key => $porter){
        $objet = $gestionDAO['objetDAO']->getObjet($porter['idObj']);
        foreach($objetEchange as $i => $echange){
            if($echange['nom'] == $objet['nom'] &&
                    $echange['heal'] == $objet['heal'] &&
                    $echange['atk'] == $objet['atk'] &&
                    $echange['def'] == $objet['def'] &&
                    $echange['dodge'] == $objet['dodge']) {
                echo $key+1 . " - Votre | " . $objet['nom'] . " - Contre | " . $marchand[$i]['nom'] . "\n";
                array_push($mesObjetsAEchanger, $objet);
                $index++;
            }
        }
    }
    if($index == 0){
        echo "Vous n'avez pas d'objet à échanger\n\n";
        readline();
        menuJoueur($gestionDAO, $personnage);
    }else{
        echo $key+2 . " - Continuer votre route\n\n";

        $choix = (int)readline('Votre choix : ');
        if($choix < 1 || $choix > $key+2){
            echo "Le marchand n'a pas compris votre demande et s'en va.\n\n";
            readline();
            menuJoueur($gestionDAO, $personnage);
        }
        
        if($choix == $key+2){
            echo "Le marchand vous souhaite une bonne journée et s'en va.\n\n";
            readline();
            menuJoueur($gestionDAO, $personnage);
        }
        
        echo "Vous avez choisi l'objet " . $objetEchange[$choix-1]['nom'] . "\n\n";
        
        $gestionDAO['porterDAO']->deletePorter($mesObjetsAEchanger[$choix-1]['id']);
        $porter = new Porter($personnage->getId(), $objetEchange[$choix-1]['id']);
        $gestionDAO['porterDAO']->addPorter($porter); 

    } 
}

function creationObjet($gestionDAO){
    $type = random(0,13);
    $heal = 0;
    $atk = 0;
    $def = 0;
    $dodge = 0;
    $isConsumable = 0;
    
    $randNiveau = rand(1,10);
    $niveauMinimum = floor(($randNiveau*$randNiveau)/10);

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

    $objet = new Objet($nom, $desc, $heal, $atk, $def, $dodge, $isConsumable, $niveauMinimum);
    $gestionDAO['objetDAO']->addObjet($objet);
    $id = $gestionDAO['objetDAO']->getLastObjetId();
    $objet = $gestionDAO['objetDAO']->getObjet($id);
    return $objet;
}

// COMBAT SALLE




// function estEmpoisoné($personnageDAO, $monstreDAO){
//     $personnage = $personnageDAO->getPersonnage(1);
//     $monstre = $monstreDAO->getMonstre(1);
//     $monstre = $monstreDAO->setPoisoned(2);
//     if
// }
 
// function potion($gestionDAO, $personnage){
//     $objet = $gestionDAO['objetDAO']->getMonstre(1);
//     $personnage->setPv($personnage->getPv() + 10);
//     $gestionDAO['personnageDAO']->updatePersonnage(1, $personnage);
//     echo "Le personnage a bu une potion, il lui reste " . $personnage->getPv() . " points de vie." ;
// }

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

function combatSalle( $personnage, $listeMonstres, $gestionDAO){
    echo "Vous êtes attaqué par " . count($listeMonstres) . " monstre" . (count($listeMonstres)!=1) ? "s" : "" ."!\n";
    $exp = 0;
    foreach($listeMonstre as $monstre){
        $exp += $monstre->getExp();
    }


    while ($personnage->getPv() > 0 && count($listeMonstres) > 0){
        if($personnage->getIsDefending() == true){
            $personnage->setIsDefending(false);
        }
        echo "Que voulez-vous faire ?\n";
        echo "1. Attaquer\n";
        echo "2. Se défendre\n";
        echo "3. Utiliser un objet\n";
        $choix = readline("Votre choix : ");
        switch ($choix) {
            case 1:
                randAtkPerso($gestionDAO, $personnage, $listeMonstre);
                foreach($listeMonstres as $key => $monstre){
                    $ennemiechoice = rand(1, 2);
                    if ($ennemiechoice == 1){
                        randAtkMonstre($gestionDAO, $personnage, $monstre);

                    } else {
                        $monstre->getIsDefending(true);
                    }
                }
                
                break;
            case 2:
                // defensePerso($gestionDAO);
                $personnage->setIsDefending(true);
                foreach($listeMonstres as $key => $monstre){
                    randAtkMonstre($gestionDAO, $personnage, $monstre);
                }
                break;
            case 3:
                // potion($gestionDAO, $personnage);
                // utiliser un objet;
                utiliserUnOBjet();
                foreach($listeMonstres as $key => $monstre){
                    randAtkMonstre($gestionDAO, $personnage, $monstre);
                }
                break;
            default:
                echo "Choix invalide\n";
                break;
        }
    } if ($personnage->getPv() <= 0){
        echo "Le personnage est mort, il a perdu la partie.";
    }elseif (count($listeMonstre)){
        echo "Le monstre est mort, le personnage a gagné la partie.";
        takeExp($gestionDAO, $personnage, $exp);
        levelUp($gestionDAO, $personnage);
    }
}

function randAtkPerso($gestionDAO, $personnage, $listeMonstre){




// function estEmpoisoné($personnageDAO, $monstreDAO){
//     $personnage = $personnageDAO->getPersonnage(1);
//     $monstre = $monstreDAO->getMonstre(1);
//     $monstre = $monstreDAO->setPoisoned(2);
//     if
// }
 
// function potion($gestionDAO, $personnage){
//     $objet = $gestionDAO['objetDAO']->getMonstre(1);
//     $personnage->setPv($personnage->getPv() + 10);
//     $gestionDAO['personnageDAO']->updatePersonnage(1, $personnage);
//     echo "Le personnage a bu une potion, il lui reste " . $personnage->getPv() . " points de vie." ;
// }

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

function combatSalle( $personnage, $listeMonstres, $gestionDAO){
    echo "Vous êtes attaqué par " . count($listeMonstres) . " monstre" . (count($listeMonstres)!=1) ? "s" : "" ."!\n";
    $exp = 0;
    foreach($listeMonstre as $monstre){
        $exp += $monstre->getExp();
    }


    while ($personnage->getPv() > 0 && count($listeMonstres) > 0){
        if($personnage->getIsDefending() == true){
            $personnage->setIsDefending(false);
        }
        echo "Que voulez-vous faire ?\n";
        echo "1. Attaquer\n";
        echo "2. Se défendre\n";
        echo "3. Utiliser un objet\n";
        $choix = readline("Votre choix : ");
        switch ($choix) {
            case 1:
                randAtkPerso($gestionDAO, $personnage, $listeMonstre);
                foreach($listeMonstres as $key => $monstre){
                    $ennemiechoice = rand(1, 2);
                    if ($ennemiechoice == 1){
                        randAtkMonstre($gestionDAO, $personnage, $monstre);

                    } else {
                        $monstre->getIsDefending(true);
                    }
                }
                
                break;
            case 2:
                // defensePerso($gestionDAO);
                $personnage->setIsDefending(true);
                foreach($listeMonstres as $key => $monstre){
                    randAtkMonstre($gestionDAO, $personnage, $monstre);
                }
                break;
            case 3:
                // potion($gestionDAO, $personnage);
                // utiliser un objet;
                utiliserUnOBjet();
                foreach($listeMonstres as $key => $monstre){
                    randAtkMonstre($gestionDAO, $personnage, $monstre);
                }
                break;
            default:
                echo "Choix invalide\n";
                break;
        }
    } if ($personnage->getPv() <= 0){
        echo "Le personnage est mort, il a perdu la partie.";
    }elseif (count($listeMonstre)){
        echo "Le monstre est mort, le personnage a gagné la partie.";
        takeExp($gestionDAO, $personnage, $exp);
        levelUp($gestionDAO, $personnage);
    }
}

function randAtkPerso($gestionDAO, $personnage, $listeMonstre){
    $dice = rand(1, 20);

    echo "Selectionnez le monstre à attaquer :\n";
    foreach($listeMonstres as $key => $monstre){
        echo $key+1 . " - " . $monstre['nom'] . " - " . $monstre['desc'] . "\n";
    }
    $choix = (int)readline('Numéro du monstre à attaquer : ');
    if($choix < 1 || $choix > count($listeMonstres)){
        randAtkPerso($gestionDAO, $personnage, $listeMonstre);
    }
    $monstre = $listeMonstres[$choix-1];

    echo "Selectionnez le monstre à attaquer :\n";
    foreach($listeMonstres as $key => $monstre){
        echo $key+1 . " - " . $monstre['nom'] . " - " . $monstre['desc'] . "\n";
    }
    $choix = (int)readline('Numéro du monstre à attaquer : ');
    if($choix < 1 || $choix > count($listeMonstres)){
        randAtkPerso($gestionDAO, $personnage, $listeMonstre);
    }
    $monstre = $listeMonstres[$choix-1];

    switch ($dice) {
        case 1:
            echo "Le personnage a raté son attaque (échec critique).\n";
            $personnage->setPv($personnage->getPv() - floor( $personnage->getAtk() / 2));
            echo "Le personnage a raté son attaque (échec critique).\n";
            $personnage->setPv($personnage->getPv() - floor( $personnage->getAtk() / 2));
            $gestionDAO['personnageDAO']->updatePerso(1, $personnage);
            break;
        case 20:
            echo "Le personnage a fait un coup critique !\n";
            $monstre->setPv($monstre->getPv() - (($personnage->getAtk() * 2)));
            $monstre->setPv($monstre->getPv() - (($personnage->getAtk() * 2)));
            $gestionDAO['monstreDAO']->updateMonstre(1, $monstre);
            echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
            break;
        default:
            if($dice + $personnage->getAtk() > $monstre->getDef() ) {
                if($monstre_>getIsDenfending() == true){
                    defensemonstre($gestionDAO, $personnage, $monstre);
                } else {
                    $monstre->setPv($monstre->getPv() - ($personnage->getAtk()));
                    $gestionDAO['monstreDAO']->updateMonstre($monstre->getId(), $monstre);
                    echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
                    
                }
            }else{
                echo "Le monstre a bloqué l'attaque du personnage.\n"
            }
            
            if($dice + $personnage->getAtk() > $monstre->getDef() ) {
                if($monstre_>getIsDenfending() == true){
                    defensemonstre($gestionDAO, $personnage, $monstre);
                } else {
                    $monstre->setPv($monstre->getPv() - ($personnage->getAtk()));
                    $gestionDAO['monstreDAO']->updateMonstre($monstre->getId(), $monstre);
                    echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
                    
                }
            }else{
                echo "Le monstre a bloqué l'attaque du personnage.\n"
            }
            
            break;
    }
    if($monstre->getPv() <= 0){
    unset($listeMonstres[$choix-1]);
    }

}


function estEmpoisoné($gestionDAO,$monstre){
    
    $monstre = $monstreDAO->getMonstre(1);
    if ($monstre->getpoisoned() != 0){
        $monstre->setPv($monstre->getPv() - 5);
        $monstre->setpoisoned($monstre->getpoisoned() - 1);
        echo "Le monstre est empoisonné, il lui reste " . $monstre->getPv() . " points de vie." ;
    }   
}


function defensePerso($gestionDAO, $personnage, $monstre) {
    
    if ($personnage->getDef() == 0) {
        echo "Le personnage n'a plus de défense. ";
        $personnage->setPv($personnage->getPv() - $monstre->getAtk());
        $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
        echo "Le monstre a attaqué le personnage, il lui reste " . $personnage->getPv() . " points de vie." ;
    } else {
        $personnage->setDef($personnage->getDef() - 1);
        $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
        $personnage->setDef($personnage->getDef() - 1);
        $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
        echo "Le personnage a subi une attaque. Nouvelle valeur de défense : {$personnage->getDef()}\n";
    }
}

function randAtkMonstre($gestionDAO, $personnage, $monstre){
    $dice = rand(1, 20);
    switch($dice){
        case 1:
            echo "Le monstre a raté son attaque.\n";
            $monstre->setPv($monstre->getPv() - floor($monstre->getAtk() / 2));
            echo "Le monstre prend " . floor($monstre->getAtk() / 2) . " dégats.\n";
            $monstre->setPv($monstre->getPv() - floor($monstre->getAtk() / 2));
            echo "Le monstre prend " . floor($monstre->getAtk() / 2) . " dégats.\n";
            break;
        case 20:
            echo "Le monstre a fait un coup critique !\n";
            $personnage->setPv($personnage->getPv() - (($monstre->getAtk() * 2)));
            $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
            echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
            $personnage->setPv($personnage->getPv() - (($monstre->getAtk() * 2)));
            $gestionDAO['personnageDAO']->updatePersonnage($personnage->getId(), $personnage);
            echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
            break;
    default:
        if($personnage->getIsDefending()){
            defensePerso($gestionDAO, $personnage, $monstre);
        } else {
            $personnage->setPv($personnage->getPv() - ($monstre->getAtk()));
            $gestionDAO['personnageDAO']->updatePersonnage($personnage->getID(), $personnage);
            echo "Le monstre a attaqué le personnage, il lui reste " . $personnage->getPv() . " points de vie." ;
            $personnage->setPv($personnage->getPv() - ($monstre->getAtk()));
            $gestionDAO['personnageDAO']->updatePersonnage($personnage->getID(), $personnage);
            echo "Le monstre a attaqué le personnage, il lui reste " . $personnage->getPv() . " points de vie." ;
        }
        break;
    }
    
    
}

function defensemonstre($gestionDAO, $personnage, $monstre){
    if ($monstre->getDef() <= 0) {
        echo "Le monstre n'a plus de défense. ";
        $monstre->setPv($monstre->getPv() - $personnage->getAtk());
        $gestionDAO['monstreDAO']->updateMonstre($monstre->getId(), $monstre);
        $gestionDAO['monstreDAO']->updateMonstre($monstre->getId(), $monstre);
        echo "Le personnage a attaqué le monstre, il lui reste " . $monstre->getPv() . " points de vie." ;
    } else {
        $monstre->setDef($monstre->getDef() - $personnage->getAtk());
        $gestionDAO['monstreDAO']->updatePersonnage(1, $monstre);
        echo "Le monstre a une attaque. Nouvelle valeur de défense : {$monstre->getDef()}\n";

    }
}

// function estEmpoisoné($personnageDAO, $monstreDAO){
//     $personnage = $personnageDAO->getPersonnage(1);
//     $monstre = $monstreDAO->getMonstre(1);
//     $monstre = $monstreDAO->setPoisoned(2);
//     if
// }
 
// function potion($gestionDAO, $personnage){
//     $objet = $gestionDAO['objetDAO']->getMonstre(1);
//     $personnage->setPv($personnage->getPv() + 10);
//     $gestionDAO['personnageDAO']->updatePersonnage(1, $personnage);
//     echo "Le personnage a bu une potion, il lui reste " . $personnage->getPv() . " points de vie." ;
// }

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

function combat($gestionDAO, $listeMonstres, $personnage, $monstre){
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
                    randAtkPerso($gestionDAO, $personnage, $monstre);
                    for($i=0; $i<count($listeMonstres); $i++){
                        $ennemiechoice = rand(1, 2);
                        if ($ennemiechoice == 1){
                            randAtkMonstre($gestionDAO, $personnage, $monstre);
    
                        } else {
                            defensemonstre($gestionDAO, $personnage, $monstre);
                        }
                    }
                    
                    break;
                case 2:
                    // defensePerso($gestionDAO);
                    $personnage->startDefending();
                    randAtkMonstre($gestionDAO, $personnage, $monstre);
                    break;
                case 3:
                    potion($gestionDAO, $personnage);
                    randAtkMonstre($gestionDAO, $personnage, $monstre);
                    break;
                default:
                    echo "Choix invalide\n";

                    break;
            }
        } if ($personnage->getPv() <= 0){
            echo "Le personnage est mort, il a perdu la partie.";
        }elseif ($monstre->getPv() <= 0){
            echo "Le monstre est mort, le personnage a gagné la partie.";
            takeExp($gestionDAO, $personnage, $monstre);
            levelUp($gestionDAO, $personnage);
        }
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