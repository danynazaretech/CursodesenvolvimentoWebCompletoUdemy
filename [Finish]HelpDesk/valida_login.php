
<?php

        session_start(); 
        
       

        $usuarios_app = array(
            array('id'=>1,'email'=> 'dany@mail.com', 'senha' =>'123456', 'perfil'=>1),
            array('id'=>2,'email'=> 'pedro@mail.com', 'senha' =>'123456', 'perfil'=>1),
            array('id'=>3,'email'=> 'mario@mail.com', 'senha' =>'abcd', 'perfil'=>1),
            array('id'=>4,'email'=> 'marcos@mail.com', 'senha' =>'abcd', 'perfil'=>2),
            array('id'=>5,'email'=> 'murilo@mail.com', 'senha' =>'abcd', 'perfil'=>2)
        );

        
        $usuario_autenticado = false;
        $usuario_id = null;
        $usuario_perfil_id = null;

        $perfis = array(1=> 'Administrativo', 2 => 'Usuario');
        foreach($usuarios_app as $user){
            if($_POST['email'] == $user['email'] &&
               $_POST['senha'] == $user['senha']){

                $usuario_autenticado = true;
                $usuario_id = $user['id'];
                $usuario_perfil_id = $user['perfil'];
                break;
            }
        }
        if($usuario_autenticado == true){
            echo 'Usuário Autenticado';
            print_r($user);
            echo '<hr>';

            $_SESSION['autenticado'] = 'SIM';
            $_SESSION['id'] = $usuario_id;
            $_SESSION['perfil_id'] = $usuario_perfil_id;

            header('Location: home.php');
        }else{
            $_SESSION['autenticado'] = 'NAO';

            header('Location: index.php?login=erro');
        }

?>
