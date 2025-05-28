<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"> <!-- HTTP 1.1 -->
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Elevador</title>

    <style>
        html{
            height: 100%;
        }
        body{
            background-color: rgb(12, 150, 190);
            height: calc(100% - 20px);
        }
        h2{
            text-align: center;
        }

        .container{
            height: 100%;
            display: grid;
            grid-template-columns: 100px 1fr 1fr;
            grid-column-gap: 10px;
        }
        .coluna{
            border: 1px solid #a6a6a6;
            background-color: white;
            height: 100%;
            display: block;
        }

        #predio-container{
            display: grid;
        }

        #predio-container table {
            justify-self: center;
            align-self: end;

            width: 80%; 
            height: fit-content;
            padding: 0 10px 10px 10px;
            background: gray;
        }

        #predio-container table td
        {
            height: 15px;
            border: 5px outset gray;
            background: rgb(111, 203, 230);
        }

        #predio-container table th{
            height: 15px;
            background-color: white;
        }

        #display-container{
            display: grid;

            grid-template-columns: 1fr;
            grid-template-rows: 60px 100px 70px 1fr;
        }

        #elevador-display{
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto;
            grid-column-gap: 10px;
            grid-row-gap: 10px;

            justify-items: center;
            align-items: center;

            background-color: white;
        }

        #elevador-display button{
            width: 40%;
            height: 60%;
            border-radius: 100%;
            border: 3px ridge orange;
            color: orange;
            font-size: 36px;
            background-color: gainsboro;
        }

        .coluna-elevador{
            background: white !important;
            width: 20px;
            position: relative;
            padding: 0 2px;
            border: none !important;
        }

        .coluna-elevador .elevadorzinho{
            width: 15px;
            height: 15px;
            background-color: black;
            margin: auto;
            top: 115px;
            position: relative;
            transition: top 0.5s ease;
        }
    </style>
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
                <input type="number" id="numero-andares" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                <button id="criar-predio">Criar prédio</button>
            </fieldset>

            <fieldset>
                <div id="andar-atual"></div>
                <button id="chamar">Chamar Andar</button>
                <input type="number" min="1" id="andar-input" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                <div id="ultimo-erro"></div>
            </fieldset>

            <div id="elevador-display">

            </div>
        </div>
    </div>

    <script type="text/javascript" src="/dist/js/app.js?v=<?php echo time(); ?>"></script>
</body>
</html>