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
        || document.getElementById("email").value == "")
    {
        alert('Por favor, preencha todos os campos');
        return false;
    }
    else
    {
        document.getElementById('form1').submit();
    }
}

avalia()
{
    classList.toggle('like');
    //document.getElementById('avalia').submit();
}


/*
var btn1 = document.querySelector('#green');
var btn2 = document.querySelector('#red');

btn1.addEventListener('click', function() {
  
    if (btn2.classList.contains('red')) {
      btn2.classList.remove('red');
    } 
  this.classList.toggle('green');
  
});

btn2.addEventListener('click', function() {
  
    if (btn1.classList.contains('green')) {
      btn1.classList.remove('green');
    } 
  this.classList.toggle('red');
  
});
*/
 