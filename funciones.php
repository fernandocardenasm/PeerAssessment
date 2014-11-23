<?php 
	
        function conectar(){
            //Localhost
            $con=@mysql_connect('localhost', 'root', '');
            @mysql_select_db('peerassessment', $con);
            //Servidor
            //$con=@mysql_connect('mysql.hostinger.co', 'u861539574_admin', 'leandro123456');
            //@mysql_select_db('u861539574_peera', $con);
            //Servidor a2hosting
            //mysql_connect('localhost', 'tblpeere_leandro', 'carbonol15');
            //mysql_select_db('tblpeere_peerassessment');

        }
        
        function crypt_blowfish_bydinvaders($password, $digito = 7) {
            $set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $salt = sprintf('$2a$%02d$', $digito);
            for($i = 0; $i < 22; $i++){
                $salt .= $set_salt[mt_rand(0, 22)];
            }
            return crypt($password, $salt);
}
        
?>
