// URL base da sua API
const baseURL = 'http://localhost:8989/api/contacts';

function fetchContacts() {
    axios.get(baseURL)
        .then(response => {
            // Iterar sobre cada contato na resposta
            response.data.forEach(contact => {
                // Acessar o nome de cada contato e imprimir no console
                console.log('Nome do contato:', contact.name);
            });
        })
        .catch(error => {
            console.error('Erro ao buscar contatos:', error);
        });
}

fetchContacts();
