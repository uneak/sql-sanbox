SELECT r.name, rrr.user_role, rrr.hourly_rate
FROM `Room_Role_Rate` rrr
         LEFT JOIN Rooms r ON rrr.room_id = r.id
WHERE r.status = 'active'
  AND rrr.user_role = 'member';