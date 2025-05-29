# Obtener todos los gatos sin adoptar, incluyendo de los gatos adoptados, solo los que adoptó un 
# usuario especifico. Los gatos debe estar ordenados por is_adopted, primero los gatos adoptados por el usuario,
# y por fecha de registro, del mas reciente al mas antiguo.
SELECT
    id,
    adopter_id,
    is_adopted,
    name,
    breed,
    created_at
FROM cats
WHERE adopter_id = 2 OR is_adopted = 0
ORDER BY is_adopted DESC, created_at DESC;
