# Clínica Veterinária - Projeto Fullstack PHP MVC

Este projeto é a segunda etapa de um trabalho acadêmico desenvolvido para a disciplina de **Fundamentos de Programação Web** da PUC-PR.

A primeira etapa consistiu no desenvolvimento do Front-end estático. Nesta segunda etapa, o projeto foi evoluído para uma aplicação **Fullstack** completa, utilizando **PHP puro** com arquitetura **MVC (Model-View-Controller)**. O objetivo foi aplicar conceitos fundamentais de desenvolvimento web.

## Funcionalidades

- **Autenticação de Usuários**: Sistema de Login e Registro com hash de senha (bcrypt) e controle de sessão.
- **Gerenciamento de Pets**: CRUD completo (Listagem, Cadastro, Edição e Exclusão) de animais de estimação vinculados ao usuário.
- **Agendamento de Serviços**: Marcação de consultas e serviços (Banho, Tosa, Vacinação) para os pets cadastrados.
- **Gestão de Agendamentos**: Visualização de agendamentos futuros e cancelamento de consultas.
- **Validações Robustas**: Validação de dados tanto no Front-end (JavaScript) quanto no Back-end (PHP).
- **Segurança**: Implementação de tokens CSRF para proteção de formulários e sanitização de inputs contra XSS.
- **Interface Responsiva**: Layout adaptável para dispositivos móveis e desktops.

## Tecnologias Utilizadas

- **Back-end**: PHP 8+ (Orientado a Objetos)
- **Banco de Dados**: MySQL
- **Front-end**: HTML5, CSS3, JavaScript (ES6 Modules)
- **Gerenciamento de Dependências**: Composer (utilizado para Autoload PSR-4)
- **Servidor Web**: Apache (com configurações de `.htaccess` para URL amigável)

## Arquitetura e Padrões

O projeto segue uma arquitetura em camadas para garantir a separação de responsabilidades:

- **MVC (Model-View-Controller)**: Estrutura base da aplicação.
- **Repository Pattern**: Camada de abstração para acesso ao banco de dados (`app/repositories`).
- **Service Layer**: Camada responsável pelas regras de negócio (`app/services`).
- **DTOs (Data Transfer Objects)**: Objetos para transporte de dados entre camadas (`app/dtos`).
- **Mappers**: Responsáveis por converter dados do banco para objetos de domínio e DTOs (`app/mappers`).
- **Router Customizado**: Sistema de rotas próprio para despachar as requisições para os controladores.

## Estrutura do Projeto

- **app/core**: Núcleo do framework (Router, Database, Helpers de Autenticação e Redirecionamento).
- **app/controllers**: Controladores que gerenciam o fluxo das requisições.
- **app/models**: Modelos de domínio (User, Pet, Appointment, Service).
- **app/views**: Arquivos de visualização (HTML/PHP).
- **public/assets**: Recursos estáticos (CSS, JS, Imagens).
- **database.sql**: Script de criação e população inicial do banco de dados.

## Instalação e Execução

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/seu-usuario/seu-repositorio.git
   ```

2. **Configuração do Banco de Dados**:
   - Crie um banco de dados MySQL chamado `clinica_db`.
   - Importe o arquivo `database.sql` localizado na raiz do projeto.
   - Verifique as credenciais de conexão no arquivo `app/config/Config.php`.

3. **Instalação de Dependências**:
   - Certifique-se de ter o Composer instalado.
   - Execute o comando para gerar o autoloader:
     ```bash
     composer dump-autoload
     ```

4. **Executando o Projeto**:
   - Utilize um servidor Apache (como XAMPP, WAMP ou Docker).
   - Aponte o document root para a pasta `public` ou acesse via URL (ex: `http://localhost/my-php-mvc-app/`).

## Contato

Desenvolvido por **Matheus Henrique** (matheus-dev-fs).

## Licença

Este projeto está sob licença MIT.