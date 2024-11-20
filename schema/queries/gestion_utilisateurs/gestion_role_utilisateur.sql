-- Modifie le rôle d'un utilisateur existant
UPDATE Users SET user_role = :user_role WHERE id = :user_id;
