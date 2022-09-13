--Programmer des procédures stockées sur le SGBD
--Créez une procédure stockée qui sélectionne les commandes non soldées (en cours de livraison), 
--puis une autre qui renvoie le délai moyen entre la date de commande et la date de facturation.


   DELIMITER $$

--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delai_moyen` (IN `commande` INT)  BEGIN

SELECT ROUND(AVG(DATEDIFF(cmd_fact_date,cmd_date))) AS "Délai moyen de livraison en jours"
FROM commande
WHERE cmd_id = commande;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `etat_commande` (IN `livr` VARCHAR(255))  BEGIN

SELECT liv_id, liv_date, liv_cmd_id, liv_etat AS "Commandes en cours de livraison"
FROM livraison
WHERE liv_etat = livr;

END$$

DELIMITER ;
        




--Gérer les vues
--Créez une vue correspondant à la jointure Produits - Fournisseurs

CREATE VIEW produit_fournisseur
AS
SELECT pro_id, pro_nom, Fournisseur.four_id
FROM `Produit`
         join Fournisseur ON Produit.four_id = Fournisseur.four_id;

--Créez une vue correspondant à la jointure Produits - Catégorie/Sous catégorie

CREATE VIEW produit_fournis_cat_souscat
AS 
SELECT pro_id, pro_nom, Fournisseur.four_id, categorie.categorie_id, Sous_categorie.souscategorie_id
FROM `Produit`
            join Fournisseur ON Produit.four_id = Fournisseur.four_id
            join Sous_categorie ON Produit.souscat_id = Sous_categorie.souscat_id
            join categorie ON Sous_categorie.categorie_id= categorie.categorie_id;



 
