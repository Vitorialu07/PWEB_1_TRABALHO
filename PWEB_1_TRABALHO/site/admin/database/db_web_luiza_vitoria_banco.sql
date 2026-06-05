SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
/* Redimensionando controles para tela DPI: 125% */
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='movimentacao_estoque' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `movimentacao_estoque` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW ENGINES;
SHOW COLLATION;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`movimentacao_estoque`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='movimentacao_estoque' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
/* #1634496361: Access violation at address 00000056C1800000 in module 'heidisql.exe'. Execution of address 00000056C1800000 Message CharCode:13 Msg:256 */
ALTER TABLE `movimentacao_estoque`
	CHANGE COLUMN `id_movimentacao` `id_movimentacao` INT(10) NOT NULL FIRST,
	ADD COLUMN `id_produto` INT(10) NOT NULL AFTER `id_movimentacao`,
	ADD PRIMARY KEY (`id_movimentacao`);
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='db_web_luiza_vitoria_banco';
SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='movimentacao_estoque' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `movimentacao_estoque` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
/* Entrando na sessão "Laragon.MySQL" */
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='produto' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `produto` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`produto`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='produto' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`movimentacao_estoque`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='movimentacao_estoque' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
/* #1634496361: Access violation at address 00000056C1800000 in module 'heidisql.exe'. Execution of address 00000056C1800000 Message CharCode:13 Msg:256 */
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='funcionario' ORDER BY ORDINAL_POSITION;
ALTER TABLE `movimentacao_estoque`
	ADD COLUMN `id_funcionario` INT(10) NOT NULL AFTER `id_produto`,
	ADD CONSTRAINT `id_produto_movimentacao` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	ADD CONSTRAINT `id_funcionario_movimentacao` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`) ON UPDATE NO ACTION ON DELETE NO ACTION;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='db_web_luiza_vitoria_banco';
SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='movimentacao_estoque' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `movimentacao_estoque` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
/* Entrando na sessão "Laragon.MySQL" */
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`movimentacao_estoque`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='movimentacao_estoque' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='cliente' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `cliente` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='cliente'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='cliente'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`cliente`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='cliente' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
/* #1634496361: Access violation at address 00000000005DE1FB in module 'heidisql.exe'. Read of address 0000000000000000 Message CharCode:13 Msg:256 */
ALTER TABLE `cliente`
	CHANGE COLUMN `cidade_estado` `cidade` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8mb4_0900_ai_ci' AFTER `rua`;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='db_web_luiza_vitoria_banco';
SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='cliente' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `cliente` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='cliente'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='cliente'   AND REFERENCED_TABLE_NAME IS NOT NULL;
/* Entrando na sessão "Laragon.MySQL" */
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='movimentacao_estoque' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `movimentacao_estoque` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`movimentacao_estoque`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='movimentacao_estoque' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='funcionario' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `funcionario` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='funcionario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='funcionario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`funcionario`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='funcionario' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`cliente`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='cliente' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`funcionario`;
/* #87: Abstract Error Message CharCode:0 Msg:514 */
/* #2: Abstract Error Message CharCode:0 Msg:514 */
ALTER TABLE `funcionario`
	CHANGE COLUMN `status` `status` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8mb4_0900_ai_ci' AFTER `funcao`;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='db_web_luiza_vitoria_banco';
SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='funcionario' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `funcionario` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='funcionario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='funcionario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
/* Entrando na sessão "Laragon.MySQL" */
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`funcionario`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='funcionario' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='produto' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `produto` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`produto`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='produto' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
/* #42: Abstract Error Message CharCode:0 Msg:514 */
/* #1634496361: Access violation at address 00000056C1800000 in module 'heidisql.exe'. Execution of address 00000056C1800000 Message CharCode:13 Msg:256 */
ALTER TABLE `produto`
	CHANGE COLUMN `categoria` `descrição` VARCHAR(100) NOT NULL DEFAULT '' COLLATE 'utf8mb4_0900_ai_ci' AFTER `nome`,
	DROP COLUMN `tipo_lente`;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='db_web_luiza_vitoria_banco';
SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='produto' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `produto` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
/* Entrando na sessão "Laragon.MySQL" */
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`produto`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='produto' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SHOW VARIABLES;
/* #1634496361: Access violation at address 00000056C1800000 in module 'heidisql.exe'. Execution of address 00000056C1800000 Message CharCode:13 Msg:256 */
/* #69: Abstract Error Message CharCode:0 Msg:514 */
/* #25: Abstract Error Message CharCode:0 Msg:514 */
/* #64: Abstract Error Message CharCode:0 Msg:514 */
/* #78: Abstract Error Message CharCode:0 Msg:514 */
/* #3: Abstract Error Message CharCode:0 Msg:514 */
CREATE TABLE `usuario` (
	`id_usuario` INT NOT NULL,
	`nome` VARCHAR(50) NOT NULL DEFAULT '',
	`email` VARCHAR(50) NOT NULL DEFAULT '',
	`login` VARCHAR(50) NOT NULL DEFAULT '',
	`senha` INT NOT NULL,
	PRIMARY KEY (`id_usuario`)
)
COLLATE='utf8mb4_0900_ai_ci'
;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='db_web_luiza_vitoria_banco';
SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='usuario' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `usuario` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='usuario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='usuario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
/* Entrando na sessão "Laragon.MySQL" */
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`usuario`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='usuario' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
/* #46: Abstract Error Message CharCode:0 Msg:514 */
ALTER TABLE `usuario`
	CHANGE COLUMN `senha` `senha` VARCHAR(50) NOT NULL DEFAULT '' AFTER `login`;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='db_web_luiza_vitoria_banco';
SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='usuario' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `usuario` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='usuario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='usuario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
/* Entrando na sessão "Laragon.MySQL" */
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`usuario`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='usuario' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='estoque' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `estoque` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`estoque`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='estoque' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='produto' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `produto` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`produto`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='produto' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='cliente' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `cliente` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='cliente'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='cliente'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`cliente`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='cliente' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
ALTER TABLE `cliente`
	CHANGE COLUMN `id_cliente` `id` INT(10) NOT NULL FIRST,
	DROP PRIMARY KEY,
	ADD PRIMARY KEY (`id`) USING BTREE;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='db_web_luiza_vitoria_banco';
SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='cliente' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `cliente` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='cliente'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='cliente'   AND REFERENCED_TABLE_NAME IS NOT NULL;
/* Entrando na sessão "Laragon.MySQL" */
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='movimentacao_estoque' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `movimentacao_estoque` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`movimentacao_estoque`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='movimentacao_estoque' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='estoque' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `estoque` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`estoque`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='estoque' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`cliente`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='cliente' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`estoque`;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='funcionario' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `funcionario` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='funcionario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='funcionario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`funcionario`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='funcionario' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
ALTER TABLE `funcionario`
	CHANGE COLUMN `id_funcionario` `id` INT(10) NOT NULL FIRST,
	DROP PRIMARY KEY,
	ADD PRIMARY KEY (`id`) USING BTREE;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='db_web_luiza_vitoria_banco';
SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='funcionario' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `funcionario` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='funcionario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='funcionario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
/* Entrando na sessão "Laragon.MySQL" */
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`funcionario`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='funcionario' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='movimentacao_estoque' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `movimentacao_estoque` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='movimentacao_estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`movimentacao_estoque`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='movimentacao_estoque' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='estoque' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `estoque` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`estoque`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='estoque' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`movimentacao_estoque`;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='cliente' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `cliente` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='cliente'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='cliente'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`cliente`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='cliente' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`estoque`;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`movimentacao_estoque`;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`funcionario`;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='produto' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `produto` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`produto`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='produto' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='usuario' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `usuario` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='usuario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='usuario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`usuario`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='usuario' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
ALTER TABLE `usuario`
	CHANGE COLUMN `id_usuario` `id` INT(10) NOT NULL FIRST,
	DROP PRIMARY KEY,
	ADD PRIMARY KEY (`id`) USING BTREE;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='db_web_luiza_vitoria_banco';
SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='usuario' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `usuario` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='usuario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='usuario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
/* Entrando na sessão "Laragon.MySQL" */
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='estoque' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `estoque` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`estoque`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='estoque' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
ALTER TABLE `estoque`
	CHANGE COLUMN `id_estoque` `id` INT(10) NOT NULL FIRST,
	DROP PRIMARY KEY,
	ADD PRIMARY KEY (`id`) USING BTREE;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='db_web_luiza_vitoria_banco';
SHOW TABLE STATUS FROM `db_web_luiza_vitoria_banco`;
SHOW FUNCTION STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW PROCEDURE STATUS WHERE `Db`='db_web_luiza_vitoria_banco';
SHOW TRIGGERS FROM `db_web_luiza_vitoria_banco`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='db_web_luiza_vitoria_banco';
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='estoque' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `estoque` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='estoque'   AND REFERENCED_TABLE_NAME IS NOT NULL;
/* Entrando na sessão "Laragon.MySQL" */
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='produto' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `produto` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='produto'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`produto`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='produto' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;
SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='db_web_luiza_vitoria_banco' AND TABLE_NAME='usuario' ORDER BY ORDINAL_POSITION;
SHOW INDEXES FROM `usuario` FROM `db_web_luiza_vitoria_banco`;
SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE   CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='usuario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE   TABLE_SCHEMA='db_web_luiza_vitoria_banco'   AND TABLE_NAME='usuario'   AND REFERENCED_TABLE_NAME IS NOT NULL;
SHOW CREATE TABLE `db_web_luiza_vitoria_banco`.`usuario`;
SELECT tc.CONSTRAINT_NAME, cc.CHECK_CLAUSE FROM `information_schema`.`CHECK_CONSTRAINTS` AS cc, `information_schema`.`TABLE_CONSTRAINTS` AS tc WHERE tc.CONSTRAINT_SCHEMA='db_web_luiza_vitoria_banco' AND tc.TABLE_NAME='usuario' AND tc.CONSTRAINT_TYPE='CHECK' AND tc.CONSTRAINT_SCHEMA=cc.CONSTRAINT_SCHEMA AND tc.CONSTRAINT_NAME=cc.CONSTRAINT_NAME;