CREATE DATABASE IF NOT EXISTS img_streetwear CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE img_streetwear;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('skatista', 'casual', 'esportivo') NOT NULL
);

CREATE TABLE calcados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    imagem VARCHAR(255),
    publico_alvo ENUM('skatista', 'casual', 'esportivo') NOT NULL
);

INSERT INTO calcados (nome, descricao, imagem, publico_alvo) VALUES
-- Skatista
('Tênis IMG Skate Pro', 'Resistência e aderência para manobras.', 'skate1.jpg', 'skatista'),
('Tênis IMG Classic', 'O estilo clássico das pistas de skate.', 'skate2.jpg', 'skatista'),
('Tênis IMG Urban Skate', 'Conforto para o dia a dia do skatista.', 'skate3.jpg', 'skatista'),
('Tênis IMG High Top', 'Proteção e estilo para os tornozelos.', 'skate4.jpg', 'skatista'),
('Tênis IMG Low Profile', 'Leveza e sensibilidade no contato com o skate.', 'skate5.jpg', 'skatista'),
-- Casual
('Sapatênis IMG Urban', 'Versatilidade para o look casual.', 'casual1.jpg', 'casual'),
('Tênis IMG Comfort', 'Máximo conforto para longas caminhadas.', 'casual2.jpg', 'casual'),
('Mocassim IMG Drive', 'Elegância e conforto para dirigir.', 'casual3.jpg', 'casual'),
('Bota IMG Adventure', 'Estilo e robustez para o dia a dia.', 'casual4.jpg', 'casual'),
('Tênis IMG Canvas', 'Leveza e descontração para o verão.', 'casual5.jpg', 'casual'),
-- Esportivo
('Tênis IMG Runner', 'Performance e amortecimento para corrida.', 'esportivo1.jpg', 'esportivo'),
('Tênis IMG Training', 'Estabilidade para os treinos na academia.', 'esportivo2.jpg', 'esportivo'),
('Chuteira IMG Futsal', 'Aderência e precisão para as quadras.', 'esportivo3.jpg', 'esportivo'),
('Tênis IMG Crossfit', 'Resistência para os treinos mais intensos.', 'esportivo4.jpg', 'esportivo'),
('Tênis IMG Trail', 'Tração e segurança para trilhas.', 'esportivo5.jpg', 'esportivo');