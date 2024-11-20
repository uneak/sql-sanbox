-- Affiche les équipements réservés aux membres
SELECT e.name
FROM Equipments e
JOIN Equipment_Role_Rate err ON e.id = err.equipment_id
WHERE err.user_role = 'member';
