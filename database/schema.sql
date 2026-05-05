CREATE DATABASE IF NOT EXISTS cofre_prompts
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE cofre_prompts;

CREATE TABLE IF NOT EXISTS projetos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT,
    cor VARCHAR(7) DEFAULT '#f48120',
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS prompts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    projeto_id INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    conteudo TEXT NOT NULL,
    modelo_ia VARCHAR(50) DEFAULT 'GPT-4',
    tags VARCHAR(255),
    versao INT DEFAULT 1,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (projeto_id) REFERENCES projetos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS historico_versoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prompt_id INT NOT NULL,
    conteudo_anterior TEXT NOT NULL,
    conteudo_novo TEXT NOT NULL,
    versao INT NOT NULL,
    alterado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    observacao VARCHAR(255),
    FOREIGN KEY (prompt_id) REFERENCES prompts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO projetos (nome, descricao, cor) VALUES
('Assistente de Código', 'Prompts para gerar e revisar código de programação', '#f48120'),
('Copywriting', 'Instruções para geração de textos de marketing', '#e040fb'),
('Análise de Dados', 'Prompts para análise e visualização de datasets', '#536dfe');

INSERT INTO prompts (projeto_id, titulo, conteudo, modelo_ia, tags, versao) VALUES
(1, 'Code Reviewer Sênior', 'Aja como um engenheiro de software sênior. Revise o seguinte código e aponte: bugs, melhorias de performance, boas práticas e sugestões de refatoração.', 'GPT-4', 'código,revisão,refatoração', 1),
(1, 'Gerador de Testes Unitários', 'Dado o seguinte código, gere testes unitários completos cobrindo os cenários de sucesso, erro e edge cases.', 'Claude', 'testes,unitários,qualidade', 1),
(2, 'Headline Magnética', 'Crie 10 headlines persuasivas para o seguinte produto/serviço, usando gatilhos mentais de urgência e exclusividade.', 'GPT-4', 'copywriting,headlines,marketing', 1),
(3, 'Explorador de Dataset', 'Analise o seguinte dataset e forneça: estatísticas descritivas, correlações relevantes, outliers e sugestões de visualização.', 'GPT-4', 'dados,análise,estatística', 1);
