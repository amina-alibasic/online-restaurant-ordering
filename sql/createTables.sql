CREATE TABLE IF NOT EXISTS MeniStavka (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(100) NOT NULL,
    opis TEXT,
    cijena DECIMAL(10, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS Narudzba (
    id INT AUTO_INCREMENT PRIMARY KEY,
    datumNarudzbe DATETIME NOT NULL,
    ukupnaCijena DECIMAL(10, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS StavkaNarudzbe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idNarudzbe INT,
    meniStavkaId INT,
    kolicina INT NOT NULL,
    FOREIGN KEY (idNarudzbe) REFERENCES Narudzba(id),
    FOREIGN KEY (meniStavkaId) REFERENCES MeniStavka(id)
);