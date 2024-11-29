-- Crear la tabla Concesionarios
CREATE TABLE Concesionarios (
    cif VARCHAR(6) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL
);

-- Crear la tabla Coches
CREATE TABLE Coches (
    matricula VARCHAR(7) PRIMARY KEY,
    marca VARCHAR(255) NOT NULL,
    modelo VARCHAR(255) NOT NULL,
    color VARCHAR(50) NOT NULL,
    concesionario_cif VARCHAR(6),
    precio DECIMAL(10, 2) NOT NULL,  
    FOREIGN KEY (concesionario_cif) REFERENCES Concesionarios(cif)
);

-- Insertar datos en la tabla Concesionarios
INSERT INTO Concesionarios (cif, nombre, direccion) VALUES
('000222', 'Concesionario 000222', 'Dirección 000222'),
('000111', 'Concesionario 000111', 'Dirección 000111');

-- Insertar datos en la tabla Coches
INSERT INTO Coches (matricula, marca, modelo, color, precio,  concesionario_cif) VALUES
('ABC1234', 'Toyota', 'Corolla', 'Blanco', 20000.00, '000222'),
('XYZ5678', 'Ford', 'Fiesta', 'Azul', 15000.00, '000222'),
('LMN8901', 'Honda', 'Civic', 'Negro', 18000.00, '000222'),
('JKL2345', 'Chevrolet', 'Malibu', 'Rojo', 22000.00,'000111'),
('QRS6789', 'Volkswagen', 'Golf', 'Gris', 21000.00, '000111'),
('TUV3456', 'Nissan', 'Sentra', 'Verde', 16000.00, '000111');