# php-fila-elevador

Projeto feito usando o servidor embutido no PHP 8.3.6

O projeto é feito com PHP puro mas antes é necessário rodar ``composer install`` para adicionar algumas dependências

Existem três formas de visualizar este projeto. Os dois primeiros métodos são acessados via navegador, necessário rodar ```php -S localhost:8000 -t public```:

● Através da interface gráfica (que devo dizer coloquei um pouco de trabalho extra aqui)

● Uma versão mais simples somente para testar o projeto, através da classe "src\Descritor". Acessar via ```http://localhost:8000/teste-simples```; 

● Através do script PHP. Rodar no CMD através da lista comandos listados abaixo:

    ```bash
    Iniciar usando php fila.php iniciar <int> (<int> capacidade | default 10)

    Visualizar a fila atual: php fila.php visualizar

    Chamar usando php fila.php chamar <int> (<int> andar)

    Mover usando php fila.php chamar <int>
    ```