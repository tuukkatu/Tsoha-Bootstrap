CREATE TABLE Arvostelija(
id SERIAL PRIMARY KEY,
username varchar(50) NOT NULL,
password varchar(50) NOT NULL
);

CREATE TABLE Tyyppi(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL
);

CREATE TABLE Olut(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
panimo varchar(50) NOT NULL,
kuvaus varchar(100),
tyyppi_id INT REFERENCES Tyyppi(id)
);

CREATE TABLE Arvostelu(
id SERIAL PRIMARY KEY,
arvosana INT NOT NULL,
arvostelupaiva DATE,
olut_id INT REFERENCES Olut(id) ON DELETE CASCADE,
arvostelija_id INT REFERENCES Arvostelija(id)
);