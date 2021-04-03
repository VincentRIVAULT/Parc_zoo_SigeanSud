<?php

// Définition de la classe AccueilView
// la mention "extends" signifie que la classe AccueilView
// hérite des propriétés et méthodes de sa classe mère "View"
class AccueilView extends View {


    /**
     * Affichage de la page Accueil
     *
     * @return void
     ********************************************************/
    public function displayAccueil() {
        // Appel du fichier config.php où sont déclarées 
        // les classes et les tables de données correspondantes
        include 'Config/config.php';

        // on affiche le contenu de la page d'accueil
        $this->page .= '
                        <section id="accueil">
                            <article id="messageAccueil">
                                <p><span class="spanBoldItalic">Bienvenue sur l\'application de gestion du parc zoologique de SigeanSud</span></p>
                            </article>
                            <article id="presentation">
                                <h2>Présentation du parc</h2>
                                <p>Située dans le Sud de la France entre Narbonne et Perpignan, sur la côte méditerranéenne et en bordure des étangs qui jalonnent le littoral languedocien, la Réserve Africaine de SigeanSud héberge plus de 3 800 animaux, sur un peu plus de 300 hectares. <br /> Parc animalier semi-naturel, l\'espace offert est suffisamment vaste pour que les animaux restent sauvages et expriment pleinement leurs comportements naturels. <br />
									<br />
									En tant qu\'établissement zoologique, la Réserve Africaine de SigeanSud s\'est donné 4 objectifs : <br />
									- Recherche : ajouter quelque chose au savoir humain dans le domaine de la faune sauvage ; <br />
									- Conservation : conserver pour les générations futures les espèces animales en voie de disparition. <br />
									- Education : aider à une meilleure connaissance de la faune sauvage et des interdépendances entre les animaux et leurs milieux. <br />
									- Loisir : offrir aux visiteurs le plaisir du spectacle de la vie sauvage. <br />
									<br />
									Au fil des années, la Réserve Africaine de SigeanSud a su créer un vaste courant d\'intérêt et de sympathie pour la faune sauvage et la nature. En 1989, s\'est constituée l\'association des Amis de la Réserve Africaine de SigeanSud, association déclarée loi 1901. <br />
									Elle participe et aide la Réserve dans ses actions de recherche scientifique, de pédagogie ou de conservation de la faune sauvage en participant à des actions de sauvetage, en animant des programmes pédagogiques destinés aux scolaires, en organisant des voyages d\'études et en attribuant des bourses à des chercheurs.</p>
                            </article>
                            <article id="photosAnimaux">
                                <h4 id="accueilH4">Quelques photos de nos animaux</h4>
                                <div class="flexBetweenWrap">
                                    <figure>
                                        <img src="bibliotheques/img/photos/photosAnimaux/Lion_Afrique.jpg" alt="photo Lion Afrique" />
                                        <figcaption>Lion d\'Afrique</figcaption>
                                    </figure>
                                    <figure>
                                        <img src="bibliotheques/img/photos/photosAnimaux/Girafes.jpg" alt="photo Girafes" />
                                        <figcaption>Girafes</figcaption>
                                    </figure>
                                    <figure>
                                        <img src="bibliotheques/img/photos/photosAnimaux/Ouistiti.jpg" alt="photo Lémurien" />
                                        <figcaption>Ouistiti</figcaption>
                                    </figure>
                                    <figure>
                                        <img src="bibliotheques/img/photos/photosAnimaux/Canari.jpg" alt="photo Canari" />
                                        <figcaption>Canari</figcaption>
                                    </figure>
                                    <figure>
                                        <img src="bibliotheques/img/photos/photosAnimaux/Tigre.jpg" alt="photo Tigre" />
                                        <figcaption>Tigre</figcaption>
                                    </figure>
                                    <figure>
                                        <img src="bibliotheques/img/photos/photosAnimaux/Cameleon.jpg" alt="photo Cameleon" />
                                        <figcaption>Caméléon</figcaption>
                                    </figure> 
                                </div>
                            </article>
                        </section>';
        
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }


    /**
     * Affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm() {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/form' . $classAccueil . '.php');
        $this->page = str_replace('{class}', $classAccueil, $this->page);
        $this->page = str_replace('{action}', 'addDB', $this->page);
        $this->page = str_replace('{id}', '', $this->page);
        $this->page = str_replace('{titre}', '', $this->page);
        $this->page = str_replace('{contenu}', '', $this->page);
        $this->displayPage();
    }
    

    /**
     * Affichage du formulaire d'edition
     *
     * @param [type] $item
     * @return void
     ******************************************************/
    public function editForm($item) {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/form' . $classAccueil . '.php');
        $this->page = str_replace('{class}', $classAccueil, $this->page);
        $this->page = str_replace('{action}', 'editDB', $this->page);
        $this->page = str_replace('{id}', $item['id'], $this->page);
        $this->page = str_replace('{titre}', $item['titre'], $this->page);
        $this->page = str_replace('{contenu}', $item['contenu'], $this->page);
        $this->displayPage();
    }
}