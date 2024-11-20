-- Insère une réservation de salle avec statut 'en attente'
INSERT INTO Reservations (user_id, room_id, start_at, end_at, status) VALUES (:user_id, :room_id, :start_at, :end_at, 'pending');
