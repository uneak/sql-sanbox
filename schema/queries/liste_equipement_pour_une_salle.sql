SELECT r.name as 'Room', e.name as 'Equipment', re.quantity
FROM `Room_Equipment` re
         INNER JOIN Equipments e ON re.equipment_id = e.id
         INNER JOIN Rooms r ON re.room_id = r.id
WHERE (r.status = 'active')
  AND (r.id = 1);