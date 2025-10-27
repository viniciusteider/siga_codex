ALTER TABLE ocorrencias_recursos
ADD COLUMN viatura_confirmou TINYINT(1) NOT NULL DEFAULT 0;

ALTER TABLE ocorrencias_recursos
ADD COLUMN horario_confirmacao DATETIME;

ALTER TABLE ocorrencias_materiais
ADD COLUMN assinatura MEDIUMTEXT;

ALTER TABLE paciente
ADD COLUMN assinatura MEDIUMTEXT;