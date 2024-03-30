# Documentação do Projeto

Este projeto é uma aplicação web para gerenciar tarefas. Ele inclui funcionalidades de criação, leitura, atualização e exclusão de tarefas.

## Funcionalidades Principais

1. **Autenticação de Usuários:** Os usuários podem se autenticar para acessar suas tarefas.
2. **Gerenciamento de Tarefas:** Os usuários podem criar, visualizar, editar e excluir suas tarefas.
3. **API de Tarefas:** Uma API RESTful está disponível para integração com outras aplicações, permitindo operações CRUD (Create, Read, Update, Delete) em tarefas.

## Tecnologias Utilizadas

- **Laravel:** Framework PHP utilizado para desenvolvimento do backend da aplicação.
- **Bootstrap:** Framework CSS utilizado para estilizar a interface do usuário.
- **MySQL:** Banco de dados relacional utilizado para armazenar os dados das tarefas e dos usuários.
- **Markdown:** Linguagem de marcação utilizada para escrever esta documentação.

## Rotas da API

As seguintes rotas estão disponíveis na API:

- **GET /api/v2/tasks:** Retorna todas as tarefas cadastradas.
- **GET /api/v2/tasks/{id}:** Retorna os detalhes de uma tarefa específica.
- **POST /api/v2/tasks:** Cria uma nova tarefa.
- **PUT /api/v2/tasks/{id}:** Atualiza os detalhes de uma tarefa existente.
- **DELETE /api/v2/tasks/{id}:** Exclui uma tarefa existente.

## Estrutura do Projeto

O projeto segue uma arquitetura MVC (Model-View-Controller) para separação de responsabilidades. A estrutura de diretórios principais inclui:

- **app:** Contém os modelos, controladores, middlewares e outros elementos da aplicação Laravel.
- **resources:** Contém os arquivos de visualização, como HTML, CSS e JavaScript.
- **routes:** Define as rotas da aplicação, mapeando URLs para controladores e métodos.
- **database:** Contém as migrações e sementes para gerenciar o esquema do banco de dados.

## Instalação e Configuração

1. Clone o repositório do projeto para o seu ambiente local.
2. Execute `composer install` para instalar as dependências do Laravel.
3. Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, como conexão com o banco de dados.
4. Execute `php artisan key:generate` para gerar a chave de aplicativo.
5. Execute `php artisan migrate` para executar as migrações do banco de dados.
6. Execute `php artisan serve` para iniciar o servidor de desenvolvimento.

## Créditos

Desenvolvido por [Luiz Guilherme](https://github.com/lvxzxn)

## Licença

Este projeto está licenciado sob a Licença MIT. Consulte o arquivo LICENSE para obter mais detalhes.