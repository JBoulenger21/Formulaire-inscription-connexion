// function OpenIns(){
//   document.getElementById('inscriptionform').style.display = "block";
//     document.getElementById('connexionform').style.display = "none";
// }
//
// function OpenConn(){
//   document.getElementById('connexionform').style.display = "block";
//     document.getElementById('inscriptionform').style.display = "none";
// }
var email = document.getElementById('email');
var password = document.getElementById('password');
var passwordVerif = document.getElementById('password-verif');
var submit = document.getElementById('submit');

passwordVerif.addEventListener('input', function(){
    // verifie les valeurs entrées dans les input password et passwordVerif
  if (password.value == passwordVerif.value) {
    // change attribut du submit
    submit.removeAttribute('disabled');
  }
});

var idform = document.getElementById('idform');
idform.addEventListener('submit', function(){
if(password.value != '' && email.value != '' && passwordconfirm.value != '' ){
return true;
} else{
if(password.value == ''){
alert('Mot de passe requis!');
}
if(email.value == ''){
alert('Email requis!');
}
if(passwordVerif.value == ''){
alert('Mot de passe requis!');
}
return false;
}
})
