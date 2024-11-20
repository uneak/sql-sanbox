-- Modifie les informations d'une salle existante
UPDATE Rooms SET name = :name, description = :description, capacity = :capacity, width = :width, length = :length, status = :status WHERE id = :room_id;
