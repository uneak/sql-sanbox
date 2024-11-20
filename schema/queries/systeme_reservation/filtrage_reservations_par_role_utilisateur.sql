-- Filtre les réservations par rôle d'utilisateur
SELECT * FROM Reservations res
JOIN Users u ON res.user_id = u.id
WHERE u.user_role = :user_role;
