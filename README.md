# PHP 8.1 + Mysql 8.0 + Symfony 5.4 + Docker

How to run?
--

1. Create Docker image

   `make build`

2. Start Docker containers

   `make start`

3. Install Dependencies

   `make composer-install`

4. Access Docker container

   `make ssh-be`

5. Install TLS certificate

   `symfony server:ca:install`

6. Up server by port 8000 in background

   `symfony server:start --port=8000 -d`

7. Open in browser

   https://127.0.0.1:1000/