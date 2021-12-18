//LINK DA API
const API = 'http://18.231.42.102:3000/api/produtos'

/**
 * Lista com todos os produtos
 */
const listarProduto = () => {
    let params = {method: 'GET'}
    fetch(API, params)
        .then(result => result.json()) //usando o metodo json()
        .then(json => {
            let html = ''
            json.forEach(produto => html += htmlLista(produto));
            document.querySelector("#listaProduto").innerHTML = html
            limparCampos()
        })
        .catch(err => console.log(err))
}

/**
 * Listando apenas um produto para edicao do mesmo
 */
const listarUmProduto = (id) => {
    let params = {method: 'GET'}
    fetch(API + "/" + id, params)
        .then(result => result.json()) //usando o metodo json()
        .then(json => {
            document.querySelector('#descricao').value = json.descricao
            document.querySelector('#_id').value = json._id
        })
        .catch(err => console.log(err))
}

/**
 * Cadastro de um produto
 */
const cadastrarProduto = () => {
    if (document.querySelector('#descricao').value === '') {
        alert("Preencha o campo!")
        return
    }
    let descricao = document.querySelector('#descricao').value
    let params = {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            descricao
        })
    }
    fetch(API, params)
        .then(result => {
            if (result.ok) {
                alert("Produto inserido com sucesso!")
                listarProduto()
            } else {
                alert("Ocorreu um erro ao inserir o produto!")
            }
        }) 
        .catch(err => alert(err))
}

/**
 * Edição do produto especifico pelo id
 * @param {int} id 
 */
const editarProduto = (id) => {
    let descricao = document.querySelector('#descricao').value
    let params = {
        method: 'PUT',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            descricao
        })
    }
    fetch(API + '/' + id, params)
        .then(result => {
            if (result.ok) {
                alert("Produto editado com sucesso!")
                listarProduto()
            } else {
                alert("Ocorreu um erro ao editar o produto!")
            }
        })
        .catch(err => alert(err))
}


/**
 * Delete do produto especifico pelo id
 * @param {int} id 
 */
const deletarProduto = (id) => {
    if (confirm("Deseja excluir esse produto?")) {
        let params = {
            method: 'DELETE'
        }
        fetch(API + '/' + id, params)
            .then(result => {
                if (result.ok) {
                    alert("Produto deletado com sucesso!")
                    listarProduto()
                } else {
                    alert("Ocorreu um erro ao deletar o produto!")
                }
            })
            .catch(err => alert(err))
    }
}

/**
 * Limpeza dos campos acima
 */
const limparCampos = () => {
    document.querySelector('#_id').value = ""
    document.querySelector('#descricao').value = ""
}

/**
 * Montando a linha do html da tabela
 * @param {object} produto 
 * @returns html
 */
const htmlLista = (produto) => {
    return `<tr>
                <th scope="row">${produto._id}</th>
                <td>${produto.descricao}</td>
                <td><a href="#" class="btn btn-primary" onclick="listarUmProduto('${produto._id}')" id="editar">EDITAR</a> <a href="#"
                        class="btn btn-danger" id="excluir" onclick="deletarProduto('${produto._id}')">EXCLUIR</td>
            </tr>`
}

/**
 * Adicionando no evento de load o listarProdutos, para mostrar todos os produtos
 */
window.addEventListener('load', listarProduto)

/**
 * Adicionando no evento de click para cadastrar ou editar um produto
 */
document.querySelector("#salvar").addEventListener("click", () => {
    let id = document.querySelector("#_id").value
    return (id === '') ? cadastrarProduto() :  editarProduto(id)
})