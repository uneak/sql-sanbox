SELECT e.id, e.name, e.description, e.total_stock - COALESCE(SUM(re.quantity), 0) AS available_quantity
FROM Equipments e
         LEFT JOIN Reservation_Equipment re ON e.id = re.equipment_id
         LEFT JOIN Reservations res ON re.reservation_id = res.id
WHERE e.id NOT IN (SELECT equipment_id
                   FROM Room_Equipment
                   WHERE room_id = :room_id)
  AND e.status = 'active'
  AND (res.start_at IS NULL OR res.end_at <= :start_time OR res.start_at >= :end_time)
GROUP BY e.id, e.name, e.description, e.total_stock
HAVING available_quantity > 0;
