-- Vérifie la disponibilité d'un équipement spécifique pour une période donnée
SELECT e.id, e.name, e.total_stock - IFNULL(SUM(re.quantity), 0) AS available_stock
FROM Equipments e
LEFT JOIN Reservation_Equipment re ON e.id = re.equipment_id
LEFT JOIN Reservations res ON re.reservation_id = res.id AND (res.start_at <= :end_time AND res.end_at >= :start_time)
WHERE e.id = :equipment_id
GROUP BY e.id;
