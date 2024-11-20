-- Filtre les salles disponibles pour un créneau horaire donné
SELECT r.*
FROM Rooms r
LEFT JOIN Reservations res ON r.id = res.room_id AND (res.start_at <= :desired_end_time AND res.end_at >= :desired_start_time)
WHERE res.id IS NULL;
