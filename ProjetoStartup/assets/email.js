function sendemail() {
    var userid = "aemtCm8lOX1RorpT4"
    emailjs.init(userid);
    var thename = document.getElementById('thename').value;
    var themail = document.getElementById('themail').value;
    var themsg = document.getElementById('themsg').value;
    var validmail = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
    if (thename == "") {
      alert("Por favor, preencha seu nome");
    }
    else if (themail == "" || themail.match(!validmail)) {
      alert("Por favor, insira um email válido");
    }

    else if (themsg == "") {
      alert("Por favor, escreva uma mensagem");
    }
    else {
      var contactdetail = {
        from_name: thename,
        to_name: '<reinald_30_2009@hotmail.com>',//crie um input no form se preferir
        from_email: themail,
        message: themsg
      };

      emailjs.send('service_xesmbwb', 'template_6h3cp07', contactdetail).then(function (res) {
        alert("Email enviado com sucesso!");
      },
        reason => {
          alert("Algum erro ocorreu!");
        })
    }
  }