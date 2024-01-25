function enviarEmailContato() {
    let load = document.getElementById('load');
    let btn = document.getElementById('btnEnviar');
    if (load.style.display === 'none') {
        load.style.display = 'block';
        btn.style.display = 'none';
    }
    const form = new FormData();
    form.append('nome', document.getElementById('nome').value);
    form.append('email', document.getElementById('email').value);
    form.append('telefone', document.getElementById('telefone').value);
    form.append('mensagem', document.getElementById('mensagem').value);
    console.log(form.values);
    fetch(new Request('http://localhost/rnumata/src/Controller/Rota.php?acao=enviar', {
        method: 'POST',
        body: form
    })).then((resposta) => {
        return resposta.json().then((retorno) => {
            if (retorno.erro) {
                limparCampos();
                load.style.display = 'none';
                btn.style.display = 'block';
                return alert(retorno.message);
            }
            setTimeout(() => {
                limparCampos();
                load.style.display = 'none';
                btn.style.display = 'block';
                alert(retorno.message);
            }, 1000);
        });
    }).catch((erro) => {
        limparCampos();
        load.style.display = 'none';
        btn.style.display = 'block';
        alert('Ocorreu um erro na requisição!');
    });
}

function limparCampos() {
    document.getElementById('nome').value = '';
    document.getElementById('email').value = '';
    document.getElementById('telefone').value = '';
    document.getElementById('mensagem').value = '';
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btnEnviar').addEventListener('click', enviarEmailContato);
});