DROP SCHEMA IF EXISTS sistematarefas;
CREATE SCHEMA IF NOT EXISTS sistematarefas DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE sistematarefas;

CREATE TABLE IF NOT EXISTS usuario (
    idUsuario INT NOT NULL AUTO_INCREMENT COMMENT 'PK da tabela de usuario',
    username VARCHAR(45) NOT NULL COMMENT 'Nome do usuário ',
	password VARCHAR(250) NOT NULL COMMENT 'Senha do usuário',
	PRIMARY KEY (idUsuario));


CREATE TABLE IF NOT EXISTS tarefas (
    idTarefa BIGINT NOT NULL AUTO_INCREMENT COMMENT 'PK da tabela de tarefas',
    nome VARCHAR(45) NOT NULL COMMENT 'Nome da tarefas',
    dataTarefa date NOT NULL COMMENT 'Data das tarefas',
	descricao TEXT NOT NULL COMMENT 'Descrição da tarefas',
	PRIMARY KEY (idTarefa));

-- usuario: admin
-- senha: admin
INSERT INTO usuario (username, password) VALUE ('admin', '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94');

INSERT INTO tarefas (nome, dataTarefa, descricao)
VALUES ('Organizar a casa','2022-10-20' ,'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
		('Preparar festa surpresa para o Roberto', '2022-12-30' ,'Lorem Ipsum is simply dummy text of the printing and typesetting industrynca not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

