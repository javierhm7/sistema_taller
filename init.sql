CREATE DATABASE taller_automotriz;
USE taller_automotriz;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE quejas_sugerencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) DEFAULT 'Anónimo',
    correo VARCHAR(100),
    mensaje TEXT NOT NULL,
    tipo ENUM('Queja', 'Sugerencia'),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
