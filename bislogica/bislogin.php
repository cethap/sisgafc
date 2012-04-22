<?php

class bislogin{
    var $msg;
    var $dao;
    var $asignacion;
    function __construct($dao,$asignacio){
        $this->dao=$dao;
        $this->asignacion=$asignacio;
    }
    function logica (){
        $username = $this->asignacion['username'];
        $password = $this->asignacion['password'];
        
        $cons=$this->dao->consulta("pass",$username);
        $regis=$this->dao->execute($cons);
        
        foreach($regis as $row){
            $res=$row[3];
        }
        
        if($res==$password)
         {
            $_SESSION['loggedIn'] = true;
            $_SESSION['heightp'] = $this->asignacion['heightp']-210;
            $_SESSION['widthp'] = $this->asignacion['widthp']-20;
            $this->msg = '<font color="077302">Bienvenido por favor Espere mientras es redirigido.</font><script type="text/javascript">window.location = "index.php";</script>';
        }else{
             $this->msg = ' Usuario/Password no coinciden. Intenta de nuevo! ';
        }
        return $this->msg;
    }
    
}
?>
