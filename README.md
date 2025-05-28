# php-fila-elevador

Projeto feito usando o servidor embutido no PHP 8.3.6

O projeto é feito com PHP puro mas antes é necessário rodar ``composer install`` para adicionar algumas dependências

Existem três formas de visualizar este projeto:

Através da interface gráfica (que devo dizer coloquei um pouco de trabalho extra aqui)

Ou uma versão mais simples somente para testar o projeto

Através do script PHP

Para usar esta opção, aqui vão os comandos:

```bash
Iniciar usando php fila.php iniciar <int> (<int> capacidade | default 10)

Visualizar a fila atual: php fila.php visualizar

Chamar usando php fila.php chamar <int> (<int> andar)

Mover usando php fila.php chamar <int>
```