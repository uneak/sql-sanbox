-- Modifie les informations d'un équipement pour l'administrateur
UPDATE Equipments SET name = :name, description = :description, total_stock = :total_stock WHERE id = :equipment_id;
