-- Annule une réservation pour l'administrateur
UPDATE Reservations SET status = 'cancelled' WHERE id = :reservation_id;
