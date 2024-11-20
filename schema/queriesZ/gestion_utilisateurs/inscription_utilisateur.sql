-- Insère un nouvel utilisateur dans la base de données avec le rôle 'user'
INSERT INTO Users (first_name, last_name, email, password, user_role, status) VALUES (:first_name, :last_name, :email, :password, 'user', 'active');
