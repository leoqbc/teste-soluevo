# Resolução do Desafio Técnico – Desenvolvedor PHP (Laravel + Front-end) 
## por Leonardo Tumadjian

## Tecnologias usadas
- Docker/Docker Compose
- Laravel v12
- PHP v8.4
- PHPUnit para testes
- MySQL
- React/NextJS/Ant design
- Git

## Funcionalidades implementadas
 - Usuários, cadastro, login e gerenciamento de acesso
 - Cadastro de Task e Visualização das tarefas e paginação
 - Não deu tempo de fazer implementação de filtros e ordenação no backend

## Entrega
 - Código no GitHub.
 - Criado um README.md:
 - Compartilhado o link do repositório.

## Como configurar o ambiente
1. Entrar na pasta *./backend* e alterar o arquivo .env.example para .env

2. Instalar as dependências do projeto backend
```composer install```

3. Abrir a pasta *./frontend* alterar o arquivo example.env.local para env.local
4. instalar dependências:
```npm install```
5. Na raiz do projeto executar:
```shell
$ docker composer up -d
```
6. Entrar na pasta backend e executar:
```shell
./exec artisan migrate
```

## Para rodar os testes unitários
```shell
./exec artisan test
```

## Para acessar o front
Basta acessar: http://localhost:3000/

A API está sendo servida em: http://localhost:8080/

## Para conhecer a API
```
# cadastro de usuário
POST localhost:8080/api/register

{
    "name": "John Doe",
    "email": "john@gmail.com",
    "password": "12345678",
    "password_confirmation": "12345678"
}

-----

# login
POST localhost:8080/api/login

{
    "email": "john@gmail.com",
    "password": "12345678"
}

----

# Logout

POST localhost:8080/api/logout
Authorization: Bearer 5|Gyj2GucgVCtyktzHGbGp0U5EccFia3WSZ5X8L7aUa46364b5

----

# Create Task
POST localhost:8080/api/tasks
Authorization: Bearer 5|Gyj2GucgVCtyktzHGbGp0U5EccFia3WSZ5X8L7aUa46364b5

{
    "title": "Um titulo aqui",
    "description": "tarefa de teste para o usuário 1",
    "status": "concluida",
    "due_date": "2025-06-30 10:22:42",
    "user_id": 2
}

----
# Busca de tarefas

GET localhost:8080/api/tasks/1?page=1
Authorization: Bearer 5|Gyj2GucgVCtyktzHGbGp0U5EccFia3WSZ5X8L7aUa46364b5

```