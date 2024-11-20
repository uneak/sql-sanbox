<?php

    namespace App\Todolist;

    /**
     * Classe Liste
     *
     * Cette classe gère une liste de tâches et permet des opérations
     * telles que l'ajout, la suppression, et la modification de l'état des tâches.
     */
    class Liste
    {

        /** @var array<Tache> Tableau des tâches de la liste */
        private array $taches;

        /**
         * Constructeur de la classe Liste.
         * Initialise la liste avec un tableau de tâches.
         *
         * @param array $taches - Un tableau associatif de tâches, où chaque clé est un identifiant et chaque valeur
         *                      est un titre.
         */
        public function __construct(array $taches = [])
        {
            $this->addTaches($taches);
        }

        /**
         * Retourne toutes les tâches de la liste.
         *
         * @return \App\Todolist\Tache[] - Un tableau d'objets Tache
         */
        public function getTaches(): array
        {
            return $this->taches;
        }

        /**
         * Ajoute une nouvelle tâche à la liste.
         *
         * @param string $id    - Identifiant unique de la tâche
         * @param string $label - Titre de la tâche
         */
        public function addTache(string $id, string $label): void
        {
            $this->taches[] = new Tache($id, $label);
        }

        /**
         * Ajoute plusieurs tâches à la liste.
         *
         * @param array $taches - Un tableau associatif de tâches (identifiant => titre)
         */
        public function addTaches(array $taches): void
        {
            foreach ($taches as $id => $label) {
                $this->addTache($id, $label);
            }
        }

        /**
         * Marque une tâche comme complétée.
         *
         * @param string $id - Identifiant de la tâche à compléter
         */
        public function completerTache(string $id): void
        {
            $tache = $this->getTacheById($id);
            $tache?->completer(); // Marque la tâche comme complétée si elle est trouvée
        }

        /**
         * Marque une tâche comme non complétée.
         *
         * @param string $id - Identifiant de la tâche à décompléter
         */
        public function decompleterTache(string $id): void
        {
            $tache = $this->getTacheById($id);
            $tache?->deCompleter(); // Marque la tâche comme non complétée si elle est trouvée
        }

        /**
         * Inverse l'état de complétion d'une tâche (complétée/non complétée).
         *
         * @param string $id - Identifiant de la tâche à inverser
         */
        public function toggleTache(string $id): void
        {
            $tache = $this->getTacheById($id);
            $tache?->toggle(); // Inverse l'état de la tâche si elle est trouvée
        }

        /**
         * Supprime une tâche de la liste par son identifiant.
         *
         * @param string $id - Identifiant de la tâche à supprimer
         */
        public function deleteTache(string $id): void
        {
            for ($i = 0; $i < count($this->taches); $i++) {
                if ($this->taches[$i]->getId() === $id) {
                    unset($this->taches[$i]); // Supprime la tâche de la liste
                }
            }
            // Réindexation du tableau pour éviter des "trous" dans les indices
            $this->taches = array_values($this->taches);
        }

        /**
         * Récupère la tâche correspondant à l'identifiant donné.
         *
         * @param string $id - Identifiant de la tâche
         *
         * @return \App\Todolist\Tache|null - Retourne l'objet Tache si trouvé, sinon null
         */
        private function getTacheById(string $id): Tache|null
        {
            foreach ($this->taches as $tache) {
                if ($tache->getId() === $id) {
                    return $tache;
                }
            }

            return null; // Retourne null si aucune tâche avec l'ID donné n'est trouvée
        }
    }
