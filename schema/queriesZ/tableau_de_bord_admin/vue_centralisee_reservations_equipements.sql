-- Affiche la vue centralisée des réservations et équipements pour l'administrateur
SELECT r.name AS room_name, res.start_at, res.end_at, e.name AS equipment_name, re.quantity
FROM Reservations res
JOIN Rooms r ON res.room_id = r.id
LEFT JOIN Reservation_Equipment re ON res.id = re.reservation_id
LEFT JOIN Equipments e ON re.equipment_id = e.id;
