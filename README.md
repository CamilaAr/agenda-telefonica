
# Agenda Telefônica - Projeto CRUD em PHP e MySQL

Este é um projeto de exemplo para uma agenda telefônica com operações CRUD (Create, Read, Update, Delete) em PHP e MySQL, desenvolvido como parte de um teste prático. A aplicação permite gerenciar contatos, incluindo múltiplos números de telefone, com interface responsiva utilizando Bootstrap.

## Funcionalidades

- **Cadastrar Contato**: Permite a adição de um novo contato, incluindo nome, idade e múltiplos números de telefone.
- **Pesquisar Contatos**: Pesquisa contatos por nome ou número de telefone.
- **Editar Contato**: Edição dos detalhes do contato, incluindo a adição e remoção de números de telefone.
- **Excluir Contato**: Remoção de contatos, com log de exclusão registrado em um arquivo de texto (`exclusao_log.txt`).
- **Interface Responsiva**: Layout ajustável para desktop e dispositivos móveis, construído com Bootstrap.

## Estrutura do Banco de Dados

O banco de dados possui duas tabelas: `Contato` e `Telefone`.

### Tabela `Contato`
| Campo | Tipo        | Descrição           |
|-------|-------------|---------------------|
| ID    | INT (PK)    | Identificador único |
| NOME  | VARCHAR(100)| Nome do contato     |
| IDADE | INT         | Idade do contato    |

### Tabela `Telefone`
| Campo      | Tipo        | Descrição                     |
|------------|-------------|--------------------------------|
| ID         | INT (PK)    | Identificador único do telefone |
| IDCONTATO  | INT (FK)    | Identificador do contato       |
| NUMERO     | VARCHAR(16) | Número de telefone            |

## Instalação e Configuração

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/CamilaAr/agenda-telefonica.git
   ```
2. **Importe o banco de dados**:
   - Crie um banco de dados chamado `agenda_telefonica`.
   - Importe o arquivo `agenda_telefonica.sql` fornecido no projeto para criar as tabelas e colunas necessárias.

3. **Configure o arquivo de conexão**:
   - No arquivo `config.php`, insira as credenciais do seu banco de dados:

   ```php
   <?php
   $host = 'localhost';
   $db = 'agenda_telefonica';
   $user = 'seu_usuario';
   $pass = 'sua_senha';

   try {
       $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e) {
       die("Erro na conexão: " . $e->getMessage());
   }
   ?>
   ```

4. **Configuração do Servidor Local**:
   - Execute o projeto em um ambiente local com PHP, como XAMPP ou WAMP.
   - Coloque os arquivos do projeto na pasta `htdocs` do XAMPP (ou equivalente no WAMP) e acesse `http://localhost/agenda-telefonica/index.php` no navegador.

## Uso

### 1. Página Inicial (`index.php`)
   - Exibe todos os contatos com opções para adicionar, editar ou excluir.
   - Campo de pesquisa para filtrar contatos por nome ou número de telefone.

### 2. Adicionar Contato (`cadastrar.php`)
   - Permite cadastrar novos contatos e adicionar múltiplos números de telefone.

### 3. Editar Contato (`editar.php`)
   - Carrega os dados do contato selecionado, permitindo alterar o nome, idade e números de telefone.

### 4. Log de Exclusão (`exclusao_log.txt`)
   - Registra cada exclusão de contato com a data e hora.

## Tecnologias Utilizadas

- **PHP**: Linguagem de backend para operações CRUD.
- **MySQL**: Banco de dados relacional para armazenamento de contatos e números de telefone.
- **Bootstrap**: Framework CSS para layout responsivo.
- **PDO (PHP Data Objects)**: Interface para acesso ao banco de dados.

## Observações

- Certifique-se de que seu servidor local possui PHP e MySQL instalados e configurados.
- Caso haja problemas na execução, verifique o arquivo `config.php` e as configurações de permissões do banco de dados.

## Autor

Este projeto foi desenvolvido como parte de um teste prático.

 
