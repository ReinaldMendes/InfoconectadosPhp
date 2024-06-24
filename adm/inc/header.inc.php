<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <title>Infoconectados Php</title>
    <style>
    .small-image {
      max-width: 10%; /* Defina o tamanho máximo desejado */
      height: auto; /* Mantenha a proporção da imagem */
    }
  </style>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <title>Infoconectados Php</title>
  <style>

  </style>
</head>

<body>
  <div class="container">
  <header>
    <div class="px-3 py-2 bg-dark text-white">
      <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="login.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <strong>
          Infoconectados Gestão
        </strong>
          <img src="img/logo.png" class="img-fluid small-image" width="100" height="82" alt="Logo Agenda"><use xlink:href="login.php"></use>
        </a>
       

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li>
              <a href="login.php" class="nav-link text-secondary">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="login.php"></use></svg>
                Inicio
              </a>
            </li>
            <li>
              <a href="gestaoCliente.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="gestaoCliente.php"></use></svg>
                Gestão Cliente
              </a>
            </li>
            <li>
              <a href="gestaoUsuario.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="gestaoUsuario.php"></use></svg>
                Gestão Usuario
              </a>

            </li>
            <li>
              <a href="gestaoPrestadores.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="gestaoPrestadores.php"></use></svg>
                Gestão Prestadores
              </a>
              
            </li>
            <li>
              <a href="gestaoSistema.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="gestaoSistema.php"></use></svg>
                Gestão Sistema
              </a>
              
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="px-3 py-2 border-bottom mb-3">
      <div class="container d-flex flex-wrap justify-content-center">
        <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto">
          
        </form>

        <div class="text-end">
          
          <a class="btn btn-primary" href="sair.php">Sair</a>
      </div>
    </div>
  </header>
   
  <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <title>Infoconectados Php</title>
    <style>
    .small-image {
      max-width: 10%; /* Defina o tamanho máximo desejado */
      height: auto; /* Mantenha a proporção da imagem */
    }
  </style>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <title>Infoconectados Php</title>
  <style>

  </style>
</head>

<body>
  <div class="container">
  <header>
    <div class="px-3 py-2 bg-dark text-white">
      <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="login.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <strong>
          Infoconectados Gestão
        </strong>
          <img src="img/logo.png" class="img-fluid small-image" width="100" height="82" alt="Logo Agenda"><use xlink:href="login.php"></use>
        </a>
       

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li>
              <a href="login.php" class="nav-link text-secondary">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="login.php"></use></svg>
                Inicio
              </a>
            </li>
            <?php
                            // Incluir classe Users e iniciar sessão
                            require_once 'classes/users.class.php';
                            
                            // Verificar se está logado
                            if(isset($_SESSION['logado'])) {
                                $users = new Users();
                                $users->setUsers($_SESSION['logado']);
                                $permissoes = $users->getPermissoes();
                                
                                // Verificar permissões para exibir os links
                                if($users->temPermissoes('add') || $users->temPermissoes('super')) {
                                    echo '<li>
                                            <a href="gestaoUsuario.php" class="nav-link text-white">
                                                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="gestaoUsuario.php"></use></svg>
                                                Gestão Usuário
                                            </a>
                                          </li>';
                                    echo '<li>
                                            <a href="gestaoCliente.php" class="nav-link text-white">
                                                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="gestaoCliente.php"></use></svg>
                                                Gestão Cliente
                                            </a>
                                          </li>';
                                }
                                
                                if($users->temPermissoes('super')) {
                                    echo '<li>
                                            <a href="gestaoSistema.php" class="nav-link text-white">
                                                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="gestaoSistema.php"></use></svg>
                                                Gestão Sistema
                                            </a>
                                          </li>';
                                }
                            }
                            ?>
                            <li>
          </ul>
        </div>
      </div>
    </div>
    <div class="px-3 py-2 border-bottom mb-3">
      <div class="container d-flex flex-wrap justify-content-center">
        <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto">
          
        </form>

        <div class="text-end">
          
          <a class="btn btn-primary" href="sair.php">Sair</a>
      </div>
    </div>
  </header>
   