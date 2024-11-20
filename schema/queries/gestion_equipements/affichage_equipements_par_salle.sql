-- Affiche les équipements disponibles pour une salle spécifique
SELECT e.name, e.description
FROM Room_Equipment re
         JOIN Equipments e ON re.equipment_id = e.id
         JOIN Rooms r ON re.room_id = r.id
WHERE r.status = 'active'
  AND re.room_id = :room_id;
