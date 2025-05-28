<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"> <!-- HTTP 1.1 -->
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Elevador</title>

    <link rel="stylesheet" href="/dist/css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <div class="coluna">
            <h2>Fila Atual</h2>
            <ul id="fila-atual"></ul>
        </div>
        <div class="coluna" id="predio-container">
            <table id="predio-table" border="1">
                
            </table>
        </div>
        <div class="coluna" id="display-container">
            <h2>Display elevador</h2>

            <fieldset>
                Numero de andares do prédio: (isto reiniciará o objeto "Elevador")
                <input type="number" id="numero-andares" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1" />
                <button id="criar-predio">Criar prédio</button>
            </fieldset>

            <fieldset>
                <div id="andar-atual"></div>
                <button id="chamar">Chamar Andar</button>
                <input type="number" min="1" id="andar-input" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1" />
                <div id="ultimo-erro"></div>
            </fieldset>

            <div id="elevador-display">

            </div>
        </div>
    </div>

    <script type="text/javascript" src="/dist/js/app.js?v=<?php echo time(); ?>"></script>
</body>
</html>