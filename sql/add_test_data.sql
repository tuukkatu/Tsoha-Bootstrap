INSERT INTO Arvostelija (nimi) VALUES ('Tuukka123');
INSERT INTO Arvostelija (nimi) VALUES ('MikkoVir');

INSERT INTO Tyyppi (nimi) VALUES ('lager');

INSERT INTO Olut (nimi, panimo) VALUES ('Koff', 'Sinebrychoff');
INSERT INTO Olut (nimi, panimo) VALUES ('BrewDog Nanny State', 'BrewDog');

INSERT INTO Arvostelu (arvosana, arvostelupaiva, olut_id, arvostelija_id) VALUES ('71', NOW(), '1', '1');