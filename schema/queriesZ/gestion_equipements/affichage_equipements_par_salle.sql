-- Affiche les équipements disponibles pour une salle spécifique
SELECT e.name, e.description
FROM Room_Equipment re
JOIN Equipments e ON re.equipment_id = e.id
WHERE re.room_id = :room_id;
