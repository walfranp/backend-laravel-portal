<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

# Backend Laravel - Portal para sindicatos, associações...

## O que é este projeto?
O projeto tem como objetivo disponibilizar extrato de gastos detalhado por associado e possibilitando a impressão. Grafico de gastos, gráfico de convênios mais utilizados, relatório de gasto com saúde e links úteis.

## Pré-requisitos
- PHP >= 7.4
- Composer
- Requer o front-end feito em Angular que se comunica com esse backend. Link: https://github.com/walfranp/front-end-angular-portal 

## Para rodar este projeto
```bash
$ composer install
$ cp .env.example .env
$ php artisan migrate #antes de rodar este comando verifique sua configuracao com banco em .env
$ php artisan passport:install --force
$ php artisan key:generate
$ php artisan db:seed #para gerar os seeders, dados de teste
$ php artisan serve
```
Acesssar pela url: http://localhost:8000
