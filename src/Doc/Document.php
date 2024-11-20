<?php

    namespace App\Doc;


    use DateTime;

    /**
     * Represente la base de tous les documents dans l'entreprise
     *
     */
    abstract class Document
    {

        /**
         * @var string le titre du document
         */
        protected string $title;

        /**
         * @var string le contenu du document
         */
        protected string $content;

        /**
         * @var string l'auteur du document
         */
        protected string $author;

        /**
         * @var \DateTime la date de création du document
         */
        protected DateTime $createdAt;

        public function __construct(string $title, string $content, string $author)
        {
            $this->title = $title;
            $this->content = $content;
            $this->author = $author;
            $this->createdAt = new DateTime();
        }

        /**
         * Renvoie les 50 premiers caractères du contenu du document
         *
         * @return string
         */
        public function getSummary(): string
        {
            return substr($this->content, 0, 50) . "...";
        }

        /**
         * Affiche les détails du document
         *
         * @return void
         */
        public function printDetails(): void
        {
            echo "Titre: " . $this->title . '<br/>';
            echo "Auteur: " . $this->author . '<br/>';
            echo "Date de création: " . $this->createdAt->format('d/m/Y H:i:s') . '<br/>';
            echo "Contenu: " . $this->getSummary() . '<br/>';
        }

        /**
         * Sauvegarde le document dans la base de données
         *
         * @return void
         */
        public function save(): void
        {
            $realContent = $this->prepare();
            // TODO: persist $realContent
            echo "Le document a été sauvegardé dans la base de données";
        }

        /**
         * cette méthode sera utilisée pour structurer le contenu du document (par exemple, en ajoutant une
         * introduction et une conclusion).
         *
         * @return string
         */
        abstract public function generate(): string;

        /**
         * Cette méthode sera utilisée pour appliquer des préparations spécifiques à chaque type de
         * document (par exemple, ajouter une page de garde pour un rapport, des signatures pour un contrat, etc.).
         *
         * @return void
         */
        abstract public function prepare(): void;
    }