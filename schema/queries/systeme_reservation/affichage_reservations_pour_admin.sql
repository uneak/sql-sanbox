-- Affiche toutes les réservations pour l'administrateur
SELECT * FROM Reservations WHERE status = 'pending' OR status = 'confirmed';
