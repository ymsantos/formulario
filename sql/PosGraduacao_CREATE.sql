-- verifica se o BD existe e exclui 
-- (IMPORTANTE: apenas para os testes, pois todos os dados serão apagados!!!)
DROP DATABASE IF EXISTS ppgcm1;

-- cria o BD
CREATE DATABASE ppgcm1;
USE ppgcm1;

-- verifica se as tabelas existem e exclui
-- DROP TABLE IF EXISTS dados_aluno;
-- DROP TABLE IF EXISTS processo_seletivo;
-- DROP TABLE IF EXISTS dados_admin;

-- cria as tabelas:

CREATE TABLE dados_aluno (
	
-- Dados Pessoais
	proc_seletivo	VARCHAR(6), 		-- PK - processo seletivo, ex.: '2013/1'
	cpf_passaporte	BIGINT,  			-- PK
	senha			VARCHAR(255), 		-- criptografar
	nome_aluno 		VARCHAR(100),
	identidade		VARCHAR(30),
	data_nasc 		DATE,
	nacionalidade 	VARCHAR(100),
	pais 			VARCHAR(100), 
	sexo 			CHAR CHECK(sexo IN('m','f')),
	endereco 		VARCHAR(250),
	bairro 			VARCHAR(100),
	cep				BIGINT,
	cidade_estado	VARCHAR(100),
	tel_fixo 		BIGINT,
	tel_celular 	BIGINT,
	email 			VARCHAR(100),
	cor_raca 		VARCHAR(30),


-- Formacao Academica

	graduacao		VARCHAR(100),
	inst_grad		VARCHAR(100),
	dtini_grad		DATE,
	dtfim_grad		DATE,
	especializacao	VARCHAR(100),
	inst_esp		VARCHAR(100),
	dtini_esp		DATE,
	dtfim_esp		DATE,
	mestrado		VARCHAR(100),
	inst_mest		VARCHAR(100),
	dtini_mest		DATE,
	dtfim_mest		DATE,
	cvlattes		VARCHAR(100),

	
-- Dados Complementares

	area_interesse		INT DEFAULT -1,
	dedicacao			INT DEFAULT -1,
	vinculo_emp			INT DEFAULT -1,
	interesse_bolsa		INT DEFAULT -1,
	exp_profissional	VARCHAR(1500),
	ic					INT DEFAULT -1,
	ic_descricao		VARCHAR(1500),
	ingles				INT DEFAULT -1,
	notamedia			FLOAT,

-- Contato Previo

	nome_docente		VARCHAR(100),

-- Local da Prova

	provalocal			VARCHAR(100),
	profnome			VARCHAR(100),
	profinst			VARCHAR(100),
	profemail			VARCHAR(100),

-- Cartas Recomendacao

	nome_r1			VARCHAR(100), 
	email_r1		VARCHAR(100),
	relacao_r1		SET('0','1','2','3','4','5'),
	outro_r1		VARCHAR(100), -- sse escolher a opcao 'outro'
	nome_r2			VARCHAR(100),
	email_r2		VARCHAR(100),
	relacao_r2		SET('0','1','2','3','4','5'),
	outro_r2		VARCHAR(100), -- sse escolher a opcao 'outro'

	
	finalizado 		BOOL DEFAULT false, -- FLAG para saber se finalizou a inscricao
	
	PRIMARY KEY (cpf_passaporte)
);


CREATE TABLE processo_seletivo (

	processo VARCHAR(6),			-- por ex.: '2013/1'
	dt_inicio DATE,					-- inicio das inscricoes
	dt_fim	DATE,					-- fim das inscricoes

	PRIMARY KEY (processo)
);

CREATE TABLE dados_admin (
	
-- 	Para guardar os dados do Admin e dos Professores

	usuario VARCHAR(100),
	nome VARCHAR(100),
	senha VARCHAR(255),

	PRIMARY KEY (usuario)

);

-- fim da criacao de tabelas

-- ***********************************

-- Adicionando chave estrangeira:

ALTER TABLE dados_aluno
ADD CONSTRAINT fk_proc_seletivo FOREIGN KEY (proc_seletivo) REFERENCES processo_seletivo (processo) 
ON DELETE RESTRICT ON UPDATE CASCADE;


-- Insere o administrador:

INSERT INTO dados_admin (usuario,nome,senha)
	VALUES ('professor','Professor PPGCM','68d5fef94c7754840730274cf4959183b4e4ec35'); --senha: professor
