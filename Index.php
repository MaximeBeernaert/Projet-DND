<?php
include_once('./Config.php');
include_once('./Classes/Personnage.php');
include_once('./Classes/Monstre.php');
include_once ('./DAO/PersonnageDAO.php');
include_once ('./DAO/MonstreDAO.php');
include_once ('./DAO/SalleDAO.php');

$personnageDAO = new PersonnageDAO($db);
$monstreDAO = new MonstreDAO($db);
$salleDAO = new SalleDAO($db);

// $personnage = new Personnage('Yohann');
// $personnageDAO->addPersonnage($personnage);

// $monstre = new Monstre('Gobelin',10, 10, 'Attaque de base', 5, 10);
// $monstreDAO->addMonstre($monstre);


function menu(){
    echo "Bienvenue Joueur";
    echo "Veux-tu : \n 1 - Charger une nouvelle partie \n2 - Charger une partie déjà créée?";
    $choice = readline("");
    switch ($choice) {
        case '1':
            $personnage = createPersonnage($personnageDAO);
            menuJoueur($personnage);
            break;
        case '2':
            $personnage = chargerPartie();
            menuJoueur($personnage);
            break;
        default:
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

    

    return $personnage;
}




// MENU PERSONNAGE 

function menuJoueur($personnage){
    // stat, avancer salle, inventaire, quitter
    popen('cls','w');
    echo ("Bienvenue dans cette nouvelle partie! \n1-Voir vos stats \n2-voir son inventaire \n3-avancer à la prochaine salle \n4-quitter");
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
            # code...
            break;
    }
    
}

function afficherPersonnage($personnage){
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
    
}

function avancerSalle($personnage){
    popen('cls', 'w');
    
}


// COMBAT SALLE




// ACTION SALLE

function ouvrirCoffre($personnage){
    popen('cls', 'w');
    
}

function activerPiege($personnage){
    popen('cls', 'w');
    
}

function marchander($personnage){
    popen('cls', 'w');
    
}


// FIN DE PARTIE





// FERMER LE JEU

function exitGame(){
    exit;
}
?>