-- Affiche les équipements supplémentaires disponibles à la réservation pour une salle
SELECT e.name, err.hourly_rate
FROM Equipments e
         JOIN Equipment_Role_Rate err ON e.id = err.equipment_id
WHERE e.id IN (SELECT equipment_id
               FROM Room_Equipment
               WHERE room_id = :room_id);
