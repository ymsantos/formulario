USE ppgcm1;
DELIMITER $$

CREATE PROCEDURE uspInserirAluno (
	proc_seletivo	VARCHAR(6),			-- processo seletivo, ex.: '2013/1'
	cpf_passaporte	BIGINT,  			-- PK
	senha			VARCHAR(255), 		-- criptografar
	nome_aluno 		VARCHAR(100),
	identidade		VARCHAR(30),
	data_nasc 		DATE,
	nacionalidade 	VARCHAR(100),
	pais			VARCHAR(100),
	sexo 			CHAR,
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

	area_interesse		INT,
	dedicacao			INT,
	vinculo_emp			INT,
	interesse_bolsa		INT,
	exp_profissional	VARCHAR(1500),
	ic					INT,
	ic_descricao		VARCHAR(1500),
	ingles				INT,
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
	relacao_r1		SET('0','1','2','3','4','5') ,
	outro_r1		VARCHAR(100), -- sse escolher a opcao 'outro'
	nome_r2			VARCHAR(100),
	email_r2		VARCHAR(100),
	relacao_r2		SET('0','1','2','3','4','5') ,
	outro_r2		VARCHAR(100) -- sse escolher a opcao 'outro'
)
BEGIN
INSERT INTO `posgrad_bd`.`dados_aluno` (proc_seletivo, cpf_passaporte, senha, nome_aluno, identidade, data_nasc, nacionalidade, pais, sexo, endereco, bairro, cep, cidade_estado, tel_fixo, tel_celular, email, cor_raca, graduacao, inst_grad, dtini_grad, dtfim_grad, especializacao, inst_esp, dtini_esp, dtfim_esp, mestrado, inst_mest, dtini_mest, dtfim_mest, cvlattes, area_interesse, dedicacao, vinculo_emp, interesse_bolsa, exp_profissional, ic, ic_descricao, ingles, notamedia, nome_docente, provalocal, profnome, profinst, profemail, nome_r1, email_r1, relacao_r1, outro_r1, nome_r2, email_r2, relacao_r2, outro_r2)
VALUES( proc_seletivo,
		cpf_passaporte,
		senha,
		nome_aluno,
		identidade,
		data_nasc,
		nacionalidade,
		pais,
		sexo,
		endereco,
		bairro,
		cep,
		cidade_estado,
		tel_fixo,
		tel_celular,
		email,
		cor_raca,
		graduacao,
		inst_grad,
		dtini_grad,
		dtfim_grad,
		especializacao,
		inst_esp,
		dtini_esp,
		dtfim_esp,
		mestrado,
		inst_mest,
		dtini_mest,
		dtfim_mest,
		cvlattes,
		area_interesse,
		dedicacao,
		vinculo_emp,
		interesse_bolsa,
		exp_profissional,
		ic,
		ic_descricao,
		ingles,
		notamedia,
		nome_docente,
		provalocal,
		profnome,
		profinst,
		profemail,
		nome_r1,
		email_r1,
		relacao_r1,
		outro_r1,
		nome_r2,
		email_r2,
		relacao_r2,
		outro_r2
);

END

$$  -- delimita o fim da procedure

CREATE PROCEDURE uspInserirProcSeletivo (processo VARCHAR(6), dt_inicio DATE, dt_fim DATE)
BEGIN
	INSERT INTO processo_seletivo (processo, dt_inicio, dt_fim)
	VALUES (processo, dt_inicio, dt_fim);
END

$$ -- fim da procedure

CREATE PROCEDURE uspInserirAdmin (usuario VARCHAR(100), nome VARCHAR(100), senha VARCHAR(255))
BEGIN
	INSERT INTO dados_admin (usuario,nome,senha)
	VALUES (usuario,nome,senha);
END

$$

CREATE PROCEDURE uspSelecionaAluno (id BIGINT, s VARCHAR(255))
BEGIN
	-- seleciona o usuario que possui determinado id e senha
	SELECT * 
	FROM dados_aluno 
	WHERE cpf_passaporte=id AND senha=s 
	ORDER BY proc_seletivo DESC LIMIT 1;
END;

$$

CREATE PROCEDURE uspUltimoPS()
BEGIN
	-- seleciona os dados do ultimo processo seletivo
	SELECT * FROM processo_seletivo WHERE processo = (SELECT max(processo) FROM processo_seletivo);
END;

$$

CREATE PROCEDURE uspAtualizaDadosAluno (
	id 				BIGINT,				-- cpf usado como id 

-- Dados Pessoais

	proc_seletivo	VARCHAR(6),			-- processo seletivo, ex.: '2013/1'
	cpf				BIGINT,  			-- PK
	senha			VARCHAR(255), 		-- criptografar
	nome_aluno 		VARCHAR(100),
	identidade		VARCHAR(30),
	data_nasc 		DATE,
	nacionalidade 	VARCHAR(100),
	pais			VARCHAR(100),
	sexo 			CHAR,
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

	area_interesse		INT,
	dedicacao			INT,
	vinculo_emp			INT,
	interesse_bolsa		INT,
	exp_profissional	VARCHAR(1500),
	ic					INT,
	ic_descricao		VARCHAR(1500),
	ingles				INT,
	notamedia			FLOAT,

-- Contato Previo

	nome_docente		VARCHAR(100),

-- Local da Prova

	provalocal		VARCHAR(100),
	profnome		VARCHAR(100),
	profinst		VARCHAR(100),
	profemail		VARCHAR(100),

-- Cartas Recomendacao

	nome_r1			VARCHAR(100), 
	email_r1		VARCHAR(100),
	relacao_r1		SET('0','1','2','3','4','5') ,
	outro_r1		VARCHAR(100), -- sse escolher a opcao 'outro'
	nome_r2			VARCHAR(100),
	email_r2		VARCHAR(100),
	relacao_r2		SET('0','1','2','3','4','5') ,
	outro_r2		VARCHAR(100), -- sse escolher a opcao 'outro'

	finalizado 		BOOL
)
BEGIN
	UPDATE dados_aluno
	SET dados_aluno.proc_seletivo = proc_seletivo,
		dados_aluno.cpf_passaporte = cpf,
		dados_aluno.senha = senha,
		dados_aluno.nome_aluno = nome_aluno, 
		dados_aluno.identidade = identidade,
		dados_aluno.data_nasc = data_nasc,
		dados_aluno.nacionalidade = nacionalidade,
		dados_aluno.pais = pais,
		dados_aluno.sexo = sexo,
		dados_aluno.endereco = endereco,
		dados_aluno.bairro = bairro,
		dados_aluno.cep = cep,
		dados_aluno.cidade_estado = cidade_estado,
		dados_aluno.tel_fixo = tel_fixo,
		dados_aluno.tel_celular =  tel_celular,
		dados_aluno.email = email,
		dados_aluno.cor_raca = cor_raca,
		dados_aluno.graduacao = graduacao,
		dados_aluno.inst_grad = inst_grad,
		dados_aluno.dtini_grad = dtini_grad,
		dados_aluno.dtfim_grad = dtfim_grad,
		dados_aluno.especializacao = especializacao,
		dados_aluno.inst_esp = inst_esp,
		dados_aluno.dtini_esp = dtini_esp,
		dados_aluno.dtfim_esp = dtfim_esp,
		dados_aluno.mestrado = mestrado,
		dados_aluno.inst_mest = inst_mest,
		dados_aluno.dtini_mest = dtini_mest,
		dados_aluno.dtfim_mest = dtfim_mest,
		dados_aluno.cvlattes = cvlattes,
		dados_aluno.area_interesse = area_interesse,
		dados_aluno.dedicacao = dedicacao,
		dados_aluno.vinculo_emp = vinculo_emp,
		dados_aluno.interesse_bolsa = interesse_bolsa,
		dados_aluno.exp_profissional = exp_profissional,
		dados_aluno.ic = ic,
		dados_aluno.ic_descricao = ic_descricao,
		dados_aluno.ingles = ingles,
		dados_aluno.notamedia = notamedia,
		dados_aluno.nome_docente = nome_docente,
		dados_aluno.provalocal = provalocal,
		dados_aluno.profnome = profnome,
		dados_aluno.profinst = profinst,
		dados_aluno.profemail = profemail,
		dados_aluno.nome_r1 = nome_r1,
		dados_aluno.email_r1 = email_r1,
		dados_aluno.relacao_r1 = relacao_r1,
		dados_aluno.outro_r1 = outro_r1,
		dados_aluno.nome_r2 = nome_r2,
		dados_aluno.email_r2 = email_r2,
		dados_aluno.relacao_r2 = relacao_r2,
		dados_aluno.outro_r2 = outro_r2,
		dados_aluno.finalizado = finalizado
	WHERE dados_aluno.cpf_passaporte = id
	LIMIT 1;
END;

$$

CREATE PROCEDURE uspAlterarPS(id VARCHAR(6), ps VARCHAR(6), inicio DATE, fim DATE)
BEGIN

	UPDATE processo_seletivo
	SET processo = ps,
		dt_inicio = inicio,
		dt_fim = fim
	WHERE processo=id;
END;

$$

CREATE PROCEDURE uspRemoverPS(ps VARCHAR(6))
BEGIN
	DELETE FROM processo_seletivo WHERE processo = ps;
END;

$$

CREATE PROCEDURE uspAtualizaDP (
	
	id				BIGINT,  			-- usa o cpf como id para que o cpf possa ser alterado
	
-- Dados Pessoais

	cpf				BIGINT,  			-- PK
	senha			VARCHAR(255), 		-- criptografar
	nome_aluno 		VARCHAR(100),
	identidade		VARCHAR(30),
	data_nasc 		DATE,
	nacionalidade 	VARCHAR(100),
	pais			VARCHAR(100),
	sexo 			CHAR,
	endereco 		VARCHAR(250),
	bairro 			VARCHAR(100),
	cep				BIGINT,
	cidade_estado	VARCHAR(100),
	tel_fixo 		BIGINT,
	tel_celular 	BIGINT,
	email 			VARCHAR(100),
	cor_raca 		VARCHAR(30)
)
BEGIN
	UPDATE dados_aluno
	SET dados_aluno.cpf_passaporte = cpf,
		dados_aluno.senha = senha,
		dados_aluno.nome_aluno = nome_aluno, 
		dados_aluno.identidade = identidade,
		dados_aluno.data_nasc = data_nasc,
		dados_aluno.nacionalidade = nacionalidade,
		dados_aluno.pais = pais,
		dados_aluno.sexo = sexo,
		dados_aluno.endereco = endereco,
		dados_aluno.bairro = bairro,
		dados_aluno.cep = cep,
		dados_aluno.cidade_estado = cidade_estado,
		dados_aluno.tel_fixo = tel_fixo,
		dados_aluno.tel_celular =  tel_celular,
		dados_aluno.email = email,
		dados_aluno.cor_raca = cor_raca
	WHERE dados_aluno.cpf_passaporte = id
	LIMIT 1;
END;

$$

CREATE PROCEDURE uspAtualizaFA (

	id				BIGINT,

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
	cvlattes		VARCHAR(100)

)
BEGIN
	UPDATE dados_aluno
	SET dados_aluno.graduacao = graduacao,
		dados_aluno.inst_grad = inst_grad,
		dados_aluno.dtini_grad = dtini_grad,
		dados_aluno.dtfim_grad = dtfim_grad,
		dados_aluno.especializacao = especializacao,
		dados_aluno.inst_esp = inst_esp,
		dados_aluno.dtini_esp = dtini_esp,
		dados_aluno.dtfim_esp = dtfim_esp,
		dados_aluno.mestrado = mestrado,
		dados_aluno.inst_mest = inst_mest,
		dados_aluno.dtini_mest = dtini_mest,
		dados_aluno.dtfim_mest = dtfim_mest,
		dados_aluno.cvlattes = cvlattes
	WHERE dados_aluno.cpf_passaporte = id
	LIMIT 1;
END;

$$

CREATE PROCEDURE uspAtualizaDC (
	
	id				BIGINT,

	-- Dados Complementares

	area_interesse		INT,
	dedicacao			INT,
	vinculo_emp			INT,
	interesse_bolsa		INT,
	exp_profissional	VARCHAR(1500),
	ic					INT,
	ic_descricao		VARCHAR(1500),
	ingles				INT,
	notamedia			FLOAT,

-- Contato Previo

	nome_docente		VARCHAR(100),

-- Local da Prova

	provalocal			VARCHAR(100),
	profnome			VARCHAR(100),
	profinst			VARCHAR(100),
	profemail			VARCHAR(100)
)
BEGIN
	UPDATE dados_aluno
	SET dados_aluno.area_interesse = area_interesse,
		dados_aluno.dedicacao = dedicacao,
		dados_aluno.vinculo_emp = vinculo_emp,
		dados_aluno.interesse_bolsa = interesse_bolsa,
		dados_aluno.exp_profissional = exp_profissional,
		dados_aluno.ic = ic,
		dados_aluno.ic_descricao = ic_descricao,
		dados_aluno.ingles = ingles,
		dados_aluno.notamedia = notamedia,
		dados_aluno.nome_docente = nome_docente,
		dados_aluno.provalocal = provalocal,
		dados_aluno.profnome = profnome,
		dados_aluno.profinst = profinst,
		dados_aluno.profemail = profemail
	WHERE dados_aluno.cpf_passaporte = id
	LIMIT 1;
END;

$$

CREATE PROCEDURE uspAtualizaCR (
	id				BIGINT,

-- Cartas Recomendacao

	nome_r1			VARCHAR(100), 
	email_r1		VARCHAR(100),
	relacao_r1		SET('0','1','2','3','4','5') ,
	outro_r1		VARCHAR(100), -- sse escolher a opcao 'outro'
	nome_r2			VARCHAR(100),
	email_r2		VARCHAR(100),
	relacao_r2		SET('0','1','2','3','4','5') ,
	outro_r2		VARCHAR(100) -- sse escolher a opcao 'outro'
)
BEGIN
	UPDATE dados_aluno
	SET dados_aluno.nome_r1 = nome_r1,
		dados_aluno.email_r1 = email_r1,
		dados_aluno.relacao_r1 = relacao_r1,
		dados_aluno.outro_r1 = outro_r1,
		dados_aluno.nome_r2 = nome_r2,
		dados_aluno.email_r2 = email_r2,
		dados_aluno.relacao_r2 = relacao_r2,
		dados_aluno.outro_r2 = outro_r2,
		dados_aluno.finalizado = finalizado
	WHERE dados_aluno.cpf_passaporte = id
	LIMIT 1;
END;
