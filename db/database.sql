-- Crear la base de datos
CREATE DATABASE omega_cars;
USE omega_cars;

-- Tabla de usuarios
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  contraseña VARCHAR(255) NOT NULL,
  pregunta_seguridad_1 TEXT NOT NULL,
  respuesta_1 VARCHAR(255) NOT NULL,
  pregunta_seguridad_2 TEXT NOT NULL,
  respuesta_2 VARCHAR(255) NOT NULL,
  pregunta_seguridad_3 TEXT NOT NULL,
  respuesta_3 VARCHAR(255) NOT NULL
);

-- Tabla de productos
CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  marca VARCHAR(100) NOT NULL,
  descripcion TEXT NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  categoria VARCHAR(100),
  stock INT DEFAULT 0
);

-- Tabla de ventas
CREATE TABLE ventas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cliente_nombre VARCHAR(100) NOT NULL,
  cliente_email VARCHAR(100) NOT NULL,
  cliente_telefono VARCHAR(20) NOT NULL,
  producto_id INT NOT NULL,
  cantidad INT NOT NULL,
  total DECIMAL(10,2) NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (producto_id) REFERENCES productos(id)
);
