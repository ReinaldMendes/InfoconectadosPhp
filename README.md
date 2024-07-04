# Infoconectados - Backend

Bem-vindo ao backend do projeto Infoconectados! Este documento fornece uma visão geral do sistema backend desenvolvido para gerenciar e controlar várias funcionalidades do sistema Infoconectados, uma plataforma de gestão de usuários, clientes, prestadores e sistemas.

## Índice

1. [Sobre o Projeto](#sobre-o-projeto)
2. [Tecnologias Utilizadas](#tecnologias-utilizadas)
3. [Estrutura do Projeto](#estrutura-do-projeto)
4. [Instalação e Configuração](#instalação-e-configuração)
5. [Funcionalidades](#funcionalidades)
6. [Rotas e Endpoints](#rotas-e-endpoints)
7. [Contribuição](#contribuição)
8. [Licença](#licença)

## Sobre o Projeto

O Infoconectados é uma plataforma que permite a gestão eficiente de usuários, clientes, prestadores de serviços e sistemas. O backend foi desenvolvido em PHP, utilizando PDO para interações seguras com o banco de dados MySQL.

## Tecnologias Utilizadas

- **PHP**: Linguagem principal para desenvolvimento do backend.
- **PDO**: Biblioteca para interação com o banco de dados.
- **MySQL**: Banco de dados relacional utilizado para armazenar as informações.
- **Bootstrap**: Framework CSS utilizado para estilização das interfaces web.
- **HTML/CSS**: Linguagens de marcação e estilo para estrutura e design das páginas.

## Estrutura do Projeto

A estrutura do projeto é organizada da seguinte forma:

```
InfoconectadosPhp/
│
├── classes/
│   ├── conexao.class.php
│   ├── prestadores.class.php
│   ├── sistema.class.php
│   └── users.class.php
│
├── inc/
│   ├── header.inc.php
│   └── footer.inc.php
│
├── css/
│   └── bootstrap.min.css
│
├── img/
│   └── logo.png
│
├── js/
│   └── bootstrap.min.js
│
├── adicionarPrestador.php
├── editarPrestador.php
├── excluirPrestador.php
├── gestaoCliente.php
├── gestaoPrestadores.php
├── gestaoSistema.php
├── gestaoUsuario.php
├── index.php
├── login.php
├── sair.php
└── verPrestadores.php
```

## Instalação e Configuração

### Pré-requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache, Nginx, etc.)

### Passos para Instalação

1. Clone o repositório:
   ```sh
   git clone https://github.com/seu-usuario/infoconectados.git
   ```

2. Navegue até o diretório do projeto:
   ```sh
   cd infoconectadosPhp
   ```

3. Configure o banco de dados:
   - Crie um banco de dados MySQL.
   - Importe o arquivo `infoconectados.sql` para criar as tabelas necessárias.

4. Configure a conexão com o banco de dados:
   - Abra o arquivo `classes/conexao.class.php`.
   - Edite as variáveis `$dbname`, `$host`, `$user` e `$password` com as informações do seu banco de dados.

5. Inicie o servidor web e acesse o projeto pelo navegador:
   ```sh
   php -S localhost:8000
   ```

6. Acesse `http://localhost:8000` no seu navegador para visualizar a aplicação.

## Funcionalidades

### Gestão de Usuários

- Adicionar, editar, excluir e listar usuários.
- Realizar login e gerenciar sessões.
- Controlar permissões de acesso.

### Gestão de Clientes

- Adicionar, editar, excluir e listar clientes.

### Gestão de Prestadores

- Adicionar, editar, excluir e listar prestadores de serviços.

### Gestão de Sistemas

- Adicionar, editar, excluir e listar sistemas.
- Controlar acesso baseado em permissões.

## Rotas e Endpoints

Aqui estão algumas das principais rotas e suas funcionalidades:

- `/login.php`: Página de login.
- `/gestaoCliente.php`: Gestão de clientes.
- `/gestaoUsuario.php`: Gestão de usuários.
- `/gestaoPrestadores.php`: Gestão de prestadores.
- `/gestaoSistema.php`: Gestão de sistemas.
- `/adicionarPrestador.php`: Adicionar prestador.
- `/editarPrestador.php`: Editar prestador.
- `/excluirPrestador.php`: Excluir prestador.
- `/verPrestadores.php`: Ver detalhes de prestador.
- `/sair.php`: Logout.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e pull requests para adicionar novas funcionalidades, corrigir bugs ou melhorar o código.

### Passos para Contribuir

1. Fork o repositório.
2. Crie uma nova branch:
   ```sh
   git checkout -b minha-nova-feature
   ```
3. Faça suas modificações e commit:
   ```sh
   git commit -m "Adiciona nova feature"
   ```
4. Envie suas alterações:
   ```sh
   git push origin minha-nova-feature
   ```
5. Abra um Pull Request no repositório original.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

---

Esperamos que este README tenha ajudado a entender melhor o backend do projeto Infoconectados. Para qualquer dúvida ou sugestão, entre em contato conosco!

---

**Infoconectados - Conectando Informações, Facilitando Gestão**
