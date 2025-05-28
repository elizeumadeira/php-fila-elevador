window.onload = () => {
    const ultimoErro = document.querySelector('#ultimo-erro');
    function getEqualDistances(start, end, n) {
        const distances = [];
        if (n < 1) {
            return null;
        }
        if (n == 1) {
            return [start];
        }
        if (n == 2) {
            return [start, end];
        }

        let range = Math.abs(start) + Math.abs(end);
        let milestone = range / n;

        for (let i = 0; i < n; i++) {
            distances.push(start + (i * milestone));
        }


        return distances.reverse();
    }

    function visualizar() {
        const fila = document.querySelector('#fila-atual');
        fila.innerHTML = '';

        fetch('/visualizar')
            .then(response => {
                // Check if the response status is OK (200-299)
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json(); // Parse the JSON from the response
            })
            .then(data => {
                if(data.erro){
                    ultimoErro.innerHTML = data.message;
                    return;
                }
                
                data.fila.forEach((item) => {
                    let li = document.createElement('li');
                    li.innerHTML = `Andar ${item}`;

                    fila.appendChild(li);
                })
            })
            .then(() => {
                fetch('/andar')
                    .then(response => {
                        // Check if the response status is OK (200-299)
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json(); // Parse the JSON from the response
                    })
                    .then(data => {
                        if(data.erro){
                            ultimoErro.innerHTML = data.message;
                            return;
                        }
                        
                        andarAtual = document.querySelector('#andar-atual');
                        andarAtual.innerHTML = 'Andar atual: ' + (data.andar);
                    })
            })
            
            .catch(error => {
                // Handle any errors that occurred during the fetch
                console.error('There was a problem with the fetch operation:', error);
                document.getElementById('output').textContent = 'Error: ' + error.message;
            });
    }

    function chamarAndar(andar){
            fetch('/chamar/' + andar)
                .then(response => {
                    // Check if the response status is OK (200-299)
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json(); // Parse the JSON from the response
                })
                .then(data => {
                    if(data.erro){
                        ultimoErro.innerHTML = data.message;
                        return;
                    }
                    
                    visualizar();
                })
                .catch(error => {
                    // Handle any errors that occurred during the fetch
                    console.error('There was a problem with the fetch operation:', error);
                });
    }

    document.querySelector('#criar-predio').addEventListener('click', () => {

        // cria o prédio
        const nAndares = document.getElementById('numero-andares').value;
        const predioTable = document.getElementById('predio-table');

        // Clear previous rows
        predioTable.innerHTML = '';

        //adiciona a primeira linha
        const firstRow = predioTable.insertRow();
        const bannerPredio = firstRow.insertCell(); // Catáslise Palace
        bannerPredio.innerHTML = `Catálise Palace`;
        bannerPredio.colSpan = 6;

        let colunaCell = null;
        let elevadorZinho = null;

        // Create new rows and cells
        for (let i = 0; i < nAndares; i++) {
            const row = predioTable.insertRow();

            //cria a coluna do elevador
            if (i == 0) {
                colunaCell = row.insertCell();
                colunaCell.textContent = ` `;
                colunaCell.className = 'coluna-elevador';
                colunaCell.rowSpan = nAndares;

                elevadorZinho = document.createElement('div');
                elevadorZinho.className = 'elevadorzinho';

                colunaCell.appendChild(elevadorZinho);
            }

            for (let j = 0; j < 5; j++) { // 5 columns
                const cell = row.insertCell();
                cell.textContent = ` `;
            }
        }

        const elevadorDisplay = document.querySelector('#elevador-display');
        elevadorDisplay.innerHTML = '';
        // cria o display
        for (let i = nAndares - 1; i >= 0 ; i--) {
            const button = document.createElement('button');
            button.className = 'andar';
            // button.id = `andar-${i}`;
            button.innerHTML = i == 0 ? 'T' : i;
            elevadorDisplay.appendChild(button);

            button.addEventListener('click', () => {
                chamarAndar(i);
            });
        }

        // trava o max da seleção
        document.querySelector('#andar-input').max = nAndares;

        const button = document.createElement('button');
        button.className = 'andar';
        button.innerHTML = `>|<`;
        button.addEventListener('click', () => {
            fetch('/mover')
                .then(response => {
                    // Check if the response status is OK (200-299)
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json(); // Parse the JSON from the response
                })
                .then(data => {
                    if(data.erro){
                        ultimoErro.innerHTML = data.message;
                        return;
                    }

                    // Handle the data from the response
                    let andar = data.andar + 1;

                    let colunaHeight = colunaCell.clientHeight;
                    // let andar = document.querySelector('#andar-input').value;
                    let numeroAndares = document.querySelector('#numero-andares').value;

                    let posicaoAndares = getEqualDistances((colunaHeight / 2) * -1, colunaHeight / 2, parseInt(numeroAndares));
                    elevadorZinho.style.top = `${posicaoAndares[parseInt(andar) - 1] + 15}px`;
                })
                .then(() => {
                    visualizar();
                })
                .catch(error => {
                    // Handle any errors that occurred during the fetch
                    console.error('There was a problem with the fetch operation:', error);
                    document.getElementById('output').textContent = 'Error: ' + error.message;
                });
        });

        elevadorDisplay.appendChild(button);

        // cria o objeto elevador
        fetch('/iniciar/' + nAndares)
            .then(response => {
                // Check if the response status is OK (200-299)
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json(); // Parse the JSON from the response
            })
            .then(data => {
                visualizar();
            })
            .catch(error => {
                // Handle any errors that occurred during the fetch
                console.error('There was a problem with the fetch operation:', error);
                document.getElementById('output').textContent = 'Error: ' + error.message;
            });
    });


    document.querySelector('#chamar').addEventListener('click', () => {
        function isNumber(value) {
            return typeof value === 'number' && !isNaN(value);
        }

        const andarInput = document.querySelector('#andar-input').value;
        if(!Number.isNaN(andarInput)){
            chamarAndar(andarInput);
        }
        console.log(Number.isNaN(andarInput))
    });

}