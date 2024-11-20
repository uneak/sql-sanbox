-- Supprime un compte utilisateur et ses données associées
DELETE FROM Users WHERE id = :user_id;
