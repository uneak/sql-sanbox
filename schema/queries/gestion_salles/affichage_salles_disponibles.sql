-- Affiche toutes les salles disponibles avec leurs équipements associés
SELECT r.id, r.name, r.capacity, r.description, e.name AS equipment_name
FROM Rooms r
LEFT JOIN Room_Equipment re ON r.id = re.room_id
LEFT JOIN Equipments e ON re.equipment_id = e.id
WHERE r.status = 'active';
