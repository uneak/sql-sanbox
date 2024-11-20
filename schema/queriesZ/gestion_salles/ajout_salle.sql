-- Ajoute une nouvelle salle avec les informations de base
INSERT INTO Rooms (name, description, capacity, width, length, status) VALUES (:name, :description, :capacity, :width, :length, 'active');
