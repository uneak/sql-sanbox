-- Filtre les salles par équipements disponibles
SELECT r.* 
FROM Rooms r
JOIN Room_Equipment re ON r.id = re.room_id
JOIN Equipments e ON re.equipment_id = e.id
WHERE e.name IN (:equipment_list);
