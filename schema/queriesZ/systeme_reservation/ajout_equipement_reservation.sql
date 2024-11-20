-- Ajoute un équipement spécifique à une réservation existante
INSERT INTO Reservation_Equipment (reservation_id, equipment_id, quantity) VALUES (:reservation_id, :equipment_id, :quantity);
