-- Filtre les salles par capacité minimale
SELECT * FROM Rooms WHERE capacity >= :min_capacity;
