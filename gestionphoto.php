<?php

/*
Cette fonction va servir à gérer l'enregistrement de l'img.
@param string $dossier : le dossier dans lequel on va enregistrer le fichier.
@param string $mode : le mode d'utilisation de notre fonction (cv ou image)
@param string $nomInput : le nom de l'input type file pris en charge par la fontion
@param int $tailleMax : la taille maximum en mégaoctets

*/
function uploadFichier($dossier, $nomInput, $place ,$mode = "img", $tailleMax = 4) {
  // On instancie une valeur maximum par défaut.
  $tailleMaxAffichee = $tailleMax." Mo";

if($mode == "image") {
    // Liste MIME images
    $listeMime = array(
      ".jpeg" => "image/jpeg",
      ".jpg" => "image/jpg",
      ".gif" => "image/gif",
      ".png" => "image/png"
    );

  } else {
    $retour = "Merci de préciser l'argument 'image'";
    return $retour;
  }

  // on "retourne" le tableau pour pouvoir accéder plus facilement aux extensions dans le message retour par défaut.
  $listeExtension = array_flip($listeMime);

  $retour = "Votre $mode doit peser moins de $tailleMaxAffichee.";
  $retour .= "<br />
  Les extensions suivantes sont acceptées : ".implode(", ", $listeExtension).".";

  // Traitement du fichier
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // récupération des données.
    // var_dump($_FILES);

    if(empty($_FILES)) {
      // Le tableau $_FILES est complètement vide (on n'a même pas de sous-tableau correspondant à l'input) : On a essayer de télécharger un fichier dépassant la valeur limite du paramètre post_max_size défini dans php.ini
      $retour = "Le fichier téléchargé est trop lourd, merci d'envoyer un fichier de moins de $tailleMaxAffichee.";

    } else {
      // on continue les tests en regardant les messages d'erreurs renvoyés par PHP.
      $fileErreur = $_FILES[$nomInput]["error"];
      switch($fileErreur) {
        case '1':
          // La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini.
          $retour = "Le fichier téléchargé est trop lourd, merci d'envoyer un fichier de moins de $tailleMaxAffichee.";
          break;
        case '2':
          // La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.
          $retour = "Le fichier téléchargé est trop lourd, merci d'envoyer un fichier de moins de $tailleMaxAffichee.";
          break;
        case '3':
          // Le fichier n'a été que partiellement téléchargé.
          $retour = "Un problème est survenu lors du téléchargement. Merci de réessayer.";
          break;
        case '4':
          // Aucun fichier n'a été téléchargé.
          $retour = "Aucun fichier n'a été téléchargé.";
          break;
        case '6':
    			// Un dossier temporaire est manquant. Introduit en PHP 5.0.3.*
          $retour = "Le téléchargement a échoué. Merci de prendre contact avec l'administrateur du site.";
    			break;
        case '7':
          // Échec de l'écriture du fichier sur le disque. Introduit en PHP 5.1.0.
          $retour = "Le téléchargement a échoué. Merci de prendre contact avec l'administrateur du site.";
          break;
        case '8';
          // Une extension PHP a arrêté l'envoi de fichier
          $retour = "Le téléchargement a échoué. Merci de prendre contact avec l'administrateur du site.";
          break;

        default; // équivaut à un code erreur 0

        // Analyse du type MIME du fichier
        // On va regarder si le type MIME du fichier correspond bien à ce qu'on attend. On pourrait être tenté d'utiliser l'élément type du sous-tableau dans $_FILES mais celui-ci est facilement contournable en changeant simplement l'extension du fichier.
        // On va utiliser une méthode plus efficace pour récupérer le type MIME réel du fichier.
        // On récupère l'adresse du fichier temporaire qu'on vient d'uploader
        $tmpFile = $_FILES[$nomInput]["tmp_name"];
        // on ouvre une nouvelle ressource fileinfo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        // on récupère le type MIME réel du fichier.
        $typeMime = finfo_file($finfo, $tmpFile);
        // on referme la ressource fileinfo.
        finfo_close($finfo);

        // on vérifie que notre type MIME est présent dans notre tableau
        if(!in_array($typeMime, $listeMime)) {
          // type MIME non accepté
          $retour = "Le format de votre fichier n'est pas accepté !";
          break;
        } else {
          // le type MIME est accepté ! On récupère l'extension liée.
          $extension = array_search($typeMime, $listeMime);

          // On a passé tous les tests, on va maintenant enregistrer notre fichier.
          // Pour cela, on va le placer dans un sous-répertoire 'cv' dans notre répertoire 'medias'.
          // on commence par regarder si le sous-répertoire existe, et si ce n'est pas le cas, on le crée automatiquement.
          if(!is_dir($dossier)) {
            // on crée le dossier
            mkdir($dossier);
          }

          // Si jamais on a déjà des documents présents dans notre dossier cv, on va les supprimer de manière
          // à ne conserver qu'un seul fichier dans le répertoire.
          // Il existe en PHP plusieurs manières de parcourir un dossier.
          // $fichiersExistants = scandir(BASE_URL."/medias/cv");
          // on va utiliser la fonction glob qui va nous retourner un tableau contenant les fichiers dans le répertoire passé en paramètre sans inclure les fichiers cachés.
          $fichiersExistants = glob($dossier."/*");

          // on boucle sur le résultat du glob
          foreach ($fichiersExistants as $fichier) {
              // on supprime les fichiers un par un
              unlink($fichier);
          }
            
            
        }
      }
    }
  }
  return $retour;
}

function getPhoto($taille = "thumb") {
  if($taille == "thumb") {
    $taille = 1;
  } else {
    $taille = 0;
  }
  if(is_dir(BASE_URL."/medias/img")) {
    $fichierCv = glob(BASE_URL."/medias/img/*");
    if(isset($fichierCv[$taille])) {
      $chemin = str_replace(BASE_URL, "", $fichierCv[$taille]);
      $image = "<img src='$chemin' id='file' class='inputfile' alt='Photo de test' />";
        return $image;
    }
  }
}



// paramétrage de mon formulaire
// nom de l'input pris en charge
$nomInput = "photofile";
// taille en Mo
$tailleMax = 10;

// BASEURL va stocker le chemin d'accès physique à la racine de notre site.
define("BASE_URL", $_SERVER["DOCUMENT_ROOT"]);

 echo getPhoto();
?>
     

<form enctype="multipart/form-data" class="" action="" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $tailleMax*1000000; ?>">
  <input type="file" name="<?php echo $nomInput; ?>" value="" />
  <button>Envoyer</button>
</form>
