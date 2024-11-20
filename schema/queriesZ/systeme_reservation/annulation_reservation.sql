-- Annule une réservation en changeant son statut en 'annulé'
UPDATE Reservations SET status = 'cancelled' WHERE id = :reservation_id;
