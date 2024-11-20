-- Définit certains équipements comme réservés aux membres uniquement
UPDATE Equipment_Role_Rate SET user_role = 'member' WHERE equipment_id = :equipment_id;
