CREATE TABLE Usuario(
    IdUsuario INT NOT NULL AUTO_INCREMENT,
    Username varchar(50) not null,
    Password varchar(50) not null,
    PRIMARY KEY (IdUsuario)
);

CREATE TABLE TipoDocumento(
    IdTipoDocumento INT NOT NULL AUTO_INCREMENT,
    Descripcion varchar(50) not null,
    PRIMARY KEY (IdTipoDocumento)
);

CREATE TABLE Documento(
    IdDocumento INT NOT NULL AUTO_INCREMENT,
    Fk_IdUsuario INT not null,
    FK_IdTipoDocumento INT not null,
    Nombre varchar(250),
    Activo bit not null,
    PRIMARY KEY (IdDocumento),
    FOREIGN KEY (Fk_IdUsuario) REFERENCES Usuario(IdUsuario),
    FOREIGN KEY (FK_IdTipoDocumento) REFERENCES TipoDocumento(IdTipoDocumento)
);
