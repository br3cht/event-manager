Antes de executar o projeto, certifique-se de ter o Docker instalado na sua máquina. Você pode baixar e instalar o Docker aqui.

Execução do Projeto
Siga os passos abaixo para executar o projeto:

Copie o arquivo de exemplo de configuração:

cp .env.example .env
Ou, se preferir, copie o arquivo e renomeie-o:

# Copie manualmente .env.example para .env e faça as alterações necessárias
Crie as imagens do Docker:

docker-compose build
Inicie os contêineres em segundo plano:

docker-compose up -d
rode o comando para entrar no docker

docker-compose exec app sh
e em seguida quando entrar no

php artisan key:generate 
Acesse o aplicativo em seu navegador através da URL http://localhost.

#Caso, a porta 80 estiver em uso podera ser trocada manualmente no .env DOCKER_HTTP_PORT


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

