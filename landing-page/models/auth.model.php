<?php

class Auth_model extends conection{
    private $nxt;
    function __construct(){
        $this->nxt = true;
    }

    public function validateLogin($email, $pwd_hash){
        // validamos los campos
        try{
            $Sql = "SELECT number ,idUser,email,name,lastName,idRol FROM users where email=? && password=?  LIMIT 1";
            $statementSql = $this->connect_pdo()->prepare($Sql);
        
            $statementSql->bindParam(1, $email);
            $statementSql->bindParam(2, $pwd_hash);
        
            if ($statementSql->execute()) {
                $nmbr = $statementSql->rowCount();
                
                if ($nmbr !== 0) {
                    $arrL = $statementSql->fetch(PDO::FETCH_ASSOC);
                    // sesión valida
                    $_SESSION['id_user'] = $arrL['idUser'];
                    $_SESSION['email'] = $arrL['email'];
                    $_SESSION['name'] = $arrL['name'];
                    $_SESSION['lName'] = $arrL['lastName'];
                    $_SESSION['rol'] = $arrL['idRol'];
                    $_SESSION['status-session'] = '1';
                    $_SESSION['number'] = $arrL['number'];
                   
                    return [
                        'code-response' => 1,
                        'dataUser' =>$arrL,
                        'status-session' => '1'
                    ];
        
                }else{
                    // Correo ó contraseña invalidos
                    return ['code-response' => 0];
                }
            }else{
                // issue with a steatement
                return ['code-response' => 2];
            }
        }catch(PDOException $e){
            echo $e;
        }


    }
    public function validateRegister($fName, $lName, $email, $number, $pwd_hash){
        // validamos los campos
        try{
            // var_dump($fName, $lName, $email, $number, $pwd_hash);
            $Sql = "SELECT email FROM users where email= :eml LIMIT 1";
            $stmP = $this->connect_pdo()->prepare($Sql);
            $stmP->bindParam('eml', $email);

            if($stmP->execute()){
                $isUserRegistered=$stmP->rowCount();
            }
        }catch(PDOException $e){
            die($e);
        }

        try{
            if($isUserRegistered === 0){
                $Sql_ = "INSERT INTO users (idUser, name, lastName, number, email, password, idRol)
                VALUES (NULL, ?, ?, ?, ?, ?, '3')";
                $statementSql = $this->connect_pdo()->prepare($Sql_);

                $statementSql->bindParam(1, $fName);
                $statementSql->bindParam(2, $lName);
                $statementSql->bindParam(3, $number);
                $statementSql->bindParam(4, $email);
                $statementSql->bindParam(5, $pwd_hash);
                    
                if ($statementSql->execute()) {                
                    return [
                        'code-response' => 0,
                    ];
                }else{
                    // issue registered a user
                    return ['code-response' => 1];
                }
            }else{
                // existent email
                return ['code-response' => 2];
            }
        }catch(Exception $e){
            die($e);
        }


    }
}

?>