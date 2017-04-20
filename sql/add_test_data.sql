

INSERT INTO Tyyppi (nimi) VALUES ('Lager');
INSERT INTO Tyyppi (nimi) VALUES ('Vehnäolut');
INSERT INTO Tyyppi (nimi) VALUES ('Berliner Weisse');
INSERT INTO Tyyppi (nimi) VALUES ('Lambic');
INSERT INTO Tyyppi (nimi) VALUES ('Stout');
INSERT INTO Tyyppi (nimi) VALUES ('Portteri');
INSERT INTO Tyyppi (nimi) VALUES ('Ale');
INSERT INTO Tyyppi (nimi) VALUES ('Bitter');
INSERT INTO Tyyppi (nimi) VALUES ('Trappist');
INSERT INTO Tyyppi (nimi) VALUES ('Alt');
INSERT INTO Tyyppi (nimi) VALUES ('Kölsch');
INSERT INTO Tyyppi (nimi) VALUES ('Sahti');
INSERT INTO Tyyppi (nimi) VALUES ('Light');
INSERT INTO Tyyppi (nimi) VALUES ('Pils');
INSERT INTO Tyyppi (nimi) VALUES ('Rauchbier');
INSERT INTO Tyyppi (nimi) VALUES ('Dortmunder');
INSERT INTO Tyyppi (nimi) VALUES ('Wieniläinen');
INSERT INTO Tyyppi (nimi) VALUES ('Märzen');
INSERT INTO Tyyppi (nimi) VALUES ('Münchener');
INSERT INTO Tyyppi (nimi) VALUES ('Bock');

INSERT INTO Olut (nimi, panimo, kuvaus) VALUES ('Koff', 'Sinebrychoff', 'raikas');
INSERT INTO Olut (nimi, panimo, kuvaus) VALUES ('BrewDog Nanny State', 'BrewDog', 'hedelmäinen');

INSERT INTO Arvostelu (arvosana, arvostelupaiva, olut_id, arvostelija_id) VALUES ('71', NOW(), '1', '1');

INSERT INTO Arvostelija (username, password) VALUES ('kissa', 'kissa123');