create database Bioreactor;
use Bioreactor;
show tables;

#Tabla usuario
CREATE TABLE Usuario (ID_USUARIO INT PRIMARY KEY, contrasena VARCHAR(50));
select * from usuario;

#tabla ambiente
CREATE TABLE Ambiente (id_ambiente INT PRIMARY KEY, temperatura DECIMAL(5, 2), humedad DECIMAL(5, 2), calidad_aire_externo VARCHAR(255),calidad_aire_generado VARCHAR(255));
select * from Ambiente;

#Tabla de Bioreactor
CREATE TABLE Bioreactor (id_bioreactor INT PRIMARY KEY,id_usuario INT,id_ambiente INT,nivel_agua DECIMAL(5, 2),temperatura_aire DECIMAL(5, 2),
FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),FOREIGN KEY (id_ambiente) REFERENCES Ambiente(id_ambiente));
select * from Bioreactor;

#Tabla de Tanque de Nutrientes
CREATE TABLE TanqueDeNutrientes (id_tanque INT PRIMARY KEY,id_bioreactor INT,nivel_agua_alimento DECIMAL(5, 2),tds_ppm DECIMAL(5, 2),
intensidad_luz DECIMAL(5, 2),FOREIGN KEY (id_bioreactor) REFERENCES Bioreactor(id_bioreactor));

Select * from TanqueDeNutrientes;
#Tabla de Agua
CREATE TABLE Agua (id_agua INT PRIMARY KEY,id_bioreactor INT,color VARCHAR(50),estatus VARCHAR(50),FOREIGN KEY (id_bioreactor) REFERENCES Bioreactor(id_bioreactor));

select * from Agua;
#Tabla de Datos
CREATE TABLE Datos (id_dato INT PRIMARY KEY,id_bioreactor INT,tipo_dato ENUM('periodico', 'constante'),valor DECIMAL(5, 2),
FOREIGN KEY (id_bioreactor) REFERENCES Bioreactor(id_bioreactor));

select * from Datos;



#vista datos.

#Esta vista combina datos clave del bioreactor, incluyendo nivel de agua, temperatura, 
#calidad del aire y el estado del agua. Es útil para monitorear rápidamente el estado del bioreactor.
CREATE VIEW Vista_Monitoreo_Bioreactor AS SELECT b.id_bioreactor,b.nivel_agua AS nivel_agua_bioreactor, b.temperatura_aire, a.temperatura AS temperatura_ambiente,a.humedad,
a.calidad_aire_externo,a.calidad_aire_generado,ag.color AS color_agua,ag.estatus AS estatus_agua FROM Bioreactor b JOIN Ambiente a ON b.id_ambiente = a.id_ambiente 
JOIN Agua ag ON b.id_bioreactor = ag.id_bioreactor;

select * from Vista_Monitoreo_Bioreactor;




#Vista de Calidad del Agua
#Esta vista proporciona información detallada sobre la calidad del agua en los bioreactores
CREATE VIEW Vista_Calidad_Agua AS SELECT b.id_bioreactor,ag.color,ag.estatus FROM Bioreactor b JOIN Agua ag ON b.id_bioreactor = ag.id_bioreactor;


#Vista de Datos Periódicos del Bioreactor
#Esta vista muestra solo los datos periódicos que se están recolectando de los bioreactores, lo cual es útil para monitoreo continuo.
CREATE VIEW VistaDatosPeriodicos AS
SELECT B.id_bioreactor, D.valor AS valor_periodico FROM Bioreactor B JOIN Datos D ON B.id_bioreactor = D.id_bioreactor
WHERE D.tipo_dato = 'periodico';


SELECT * FROM bioreactor.agua;
select * from bioreactor.ambiente;
SELECT * FROM bioreactor.bioreactor;
SELECT * FROM bioreactor.datos;
SELECT * FROM bioreactor.tanquedenutrientes;
SELECT * FROM bioreactor.usuario;
