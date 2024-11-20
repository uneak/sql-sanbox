<?php

    namespace App\Todolist;

    /**
     * Class Tache
     *
     * Représente une tâche avec un identifiant, un titre et un statut (complétée ou non).
     */
    class Tache
    {
        // Propriétés privées pour l'identifiant, le titre et l'état de complétion de la tâche
        private string $id;       // Identifiant unique de la tâche
        private string $titre;    // Titre de la tâche
        private bool $completee;  // Statut de la tâche (vrai si complétée, faux sinon)

        /**
         * Constructeur de la classe Tache.
         * Initialise l'identifiant et le titre de la tâche.
         * Le statut de complétion est initialisé à faux (non complétée).
         *
         * @param string $id    - Identifiant unique de la tâche
         * @param string $titre - Titre de la tâche
         */
        public function __construct(string $id, string $titre)
        {
            $this->id = $id;
            $this->titre = $titre;
            $this->completee = false;  // La tâche est initialement non complétée
        }

        /**
         * Renvoie l'identifiant de la tâche.
         *
         * @return string
         */
        public function getId(): string
        {
            return $this->id;
        }

        /**
         * Renvoie le titre de la tâche.
         *
         * @return string
         */
        public function getTitre(): string
        {
            return $this->titre;
        }

        /**
         * Vérifie si la tâche est complétée.
         *
         * @return bool - Retourne vrai si la tâche est complétée, faux sinon.
         */
        public function estCompletee(): bool
        {
            return $this->completee;
        }

        /**
         * Marque la tâche comme complétée.
         */
        public function completer(): void
        {
            $this->completee = true;
        }

        /**
         * Marque la tâche comme non complétée.
         */
        public function deCompleter(): void
        {
            $this->completee = false;
        }

        /**
         * Bascule l'état de complétion de la tâche.
         * Si elle est complétée, elle devient non complétée, et inversement.
         */
        public function toggle(): void
        {
            if ($this->completee === true) {
                $this->deCompleter();
            } else {
                $this->completer();
            }
        }
    }
