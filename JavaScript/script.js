function verifica_campos_noticias()
{
    if(document.getElementById("titulo").value == ""
        || document.getElementById("texto").value == ""
        || document.getElementById("arquivo").value == "")
    {
        alert('Por favor, preencha todos os campos');
        return false;
    }
    else
    {
        document.getElementById('form1').submit();
    }
}

function verifica_campos_usuario()
{
    if(document.getElementById("nome").value == ""
        || document.getElementById("email").value == ""
        || document.getElementById("senha").value == "")
    {
        alert('Por favor, preencha todos os campos');    
        return false;
    }
    else
    {
        document.getElementById('form1').submit();
    }
}

