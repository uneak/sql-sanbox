-- Modifie les détails d'une réservation pour l'administrateur
UPDATE Reservations SET start_at = :start_at, end_at = :end_at WHERE id = :reservation_id;
