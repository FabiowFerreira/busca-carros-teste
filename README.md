<h1>
    <p>BUSCA CARROS TESTE</p>
</h1>

## Sobre esse projeto

Busca Carros Teste foi desenvolvido com o objetivo de obter os dados contidos em uma página html para em seguida executar a manipulação dos mesmos. O projeto utiliza o framework Laravel na versão 8.
## O que esse projeto faz ❓
Busca Carros Teste executa uma requisição à url https://www.questmultimarcas.com.br/estoque?termo=audi passando como termo de busca uma string informada pelo usuário. O retorno dessa requição é o conteúdo da página toda, que contém uma lista de carros com suas respectivas listas de atributos, em forma de string. Em seguida, através da utilização de Expressões Regulares (regex), obtém-se apenas certos atributos (nome, cor, quilometragem, etc)  referentes a cada carro e, por fim, faz o tratamento desses dados para poder inserir em sua base de dados cada carro com seus devidos atributos. O projeto conta com uma view para fazer listagem da sua base de dados e com autenticação para seus usuários. Só é possível inserir, listar e excluir dados estando autenticado.

## O que foi utilizado nesse projeto ❓
- [Laravel](https://laravel.com)
- PHP 8.0.11
- [MySql](https://www.mysql.com)
- Bootstrap
- Font Awesome
- Breeze
- Jetstrap

## Como executar esse projeto ❓
### Pré requisitos
- Servidor Apache
- Banco de dados MySql
- Php
- Composer
- Node
### Após clonar:
1. Renomear .env.example para .env e configurar as variáveis de conexão ao BD de acordo com o seu ambiente.
2.  
````bash
# baixar as dependências com npm
npm i 
````
3.
````bash
# atualizar dependências e composer.lock
composer update
````
4.
````bash
# setar aplication encrypted key
php artisan key:generate
````
5.
````bash
# rodar 
php artisan serve
````


 
