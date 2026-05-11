<?php

    // Este script constroi o menu lateral

    // mostra o nome do utilizador
    echo "<texto id='username'> $username </texto>";

    // mostra o botão de logout
    echo "<a href='logout.php'><img id='logout' src='logout.png'></img></a>";
    echo "<br><br><br><hr>";
       
    // primeira opcao 'home' aparece para todos os utilizadores
    echo "<a href='welcome.php'><p class='menuitem'>Home</p><a>";

    // a opcao 'enviar mensagem' é só para utilizadores normais e admins
    if ($role == 'user' || $role == 'admin')
      echo "<a href='enviar_mensagem.php'><p class='menuitem'>Enviar mensagem ao gestor</p></a>";
    
    // a opcao 'ver mensagens' é só para admins e gestores
    if ($role == 'gestor' || $role == 'admin')
      echo "<a href='ver_mensagens.php'><p class='menuitem'>Ver mensagens de clientes</p></a>";
    
    // os admins podem também gerir utilizadores e adicionar novos utilizadores
    if ($role == 'admin') {
      echo "<a href='gerir_utilizadores.php'><p class='menuitem'>Gerir utilizadores</p></a>";
      echo "<a href='adicionar_utilizador.php'><p class='menuitem'>Adicionar utilizador</p></a>";
    }
?>
