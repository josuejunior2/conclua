
## CONCLUA: Sistema de Controle de estágio e TCC do curso de Administração - Unimontes
<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<img alt="Static Badge" src="https://img.shields.io/badge/php-8.2.13-black">
<img alt="Static Badge" src="https://img.shields.io/badge/composer-2.7.6-white">
<img alt="Static Badge" src="https://img.shields.io/badge/laravel-10.35.0-red">
<img alt="Static Badge" src="https://img.shields.io/badge/npm-10.2.3-purple">
</p>


## Funcionalidades

- Cadastro de admins, orientadores, acadêmicos;
- Vínculo entre acadêmicos e orientadores;
- Fluxo de atividades com arquivos e comentários.

## Instalação

    #Clone esse repositório
    git clone https://github.com/josuejunior2/conclua.git
    
    #Entre no diretório em que ele está
    cd conclua

    #Instale as dependências necessárias
    composer install

    npm install

    #Renomeie o .env.example para .env  e configure com as informações do seu banco de dados

    #Gere a key
    php artisan key:generate 

    #Execute as migrations
    php artisan migrate --seed

    #Sirva a aplicação
    php artisan serve

    npm run dev



## Muito obrigado!
