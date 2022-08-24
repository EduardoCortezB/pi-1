<?php

class Auth_controller extends Auth_model{
    private $name;
    private $lastName;
    private $email;
    private $number;
    private $password;
    private $password_;
    private $arrD;

    function __construct(){
        
    }

    public function login($email, $password){
        $this->email = $email;
        $this->password = hash_hmac('sha256', $password, 'dsWnd!s#$932uend#$eqSAdxS3E2WQ!_!EWD0R43RS2432W4EWE__eWE3//EWe_-');

        if($this->email  != '' && $this->password != ''){

            $arrD=$this->validateLogin($this->email,$this->password);
            switch ($arrD['code-response']) {
                case '1':
                    // ta' good
                    echo json_encode($arrD);
                break;
                
                case 0:
                    // invalid credentials
                    echo json_encode($arrD);
                break;

                case 2:
                    // issue with execution of query
                    echo json_encode($arrD);
                break;
                
                default:
                    # code...
                    break;
            }
        }else{
            echo json_encode([
                'code-response' => 3
            ]);
        } 
    }

    public function register($fName, $lName, $email, $number, $password_){
        $this->email = $email;
        $this->name = $fName;
        $this->lastName = $lName;
        $this->number = $number;
        $this->password = hash_hmac('sha256', $password_, 'dsWnd!s#$932uend#$eqSAdxS3E2WQ!_!EWD0R43RS2432W4EWE__eWE3//EWe_-');

        if($this->email  != '' && $this->name != '' && $this->lastName != '' && $this->number != '' && $this->password != ''){

            //$fName, $lName, $email, $number, $pwd_hash
            $arrD=$this->validateRegister($this->name,$this->lastName,$this->email,$this->number,$this->password);
            switch ($arrD['code-response']) {
                case '1':
                    // error to register at user
                    echo json_encode($arrD);
                break;
                
                case 0:
                    // allright
                    echo json_encode($arrD);
                break;

                case 2:
                    // email existent
                    echo json_encode($arrD);
                break;
                
                default:
                    # code...
                    break;
            }
        }else{
            echo json_encode([
                'code-response' => 3
            ]);
        } 

    }

    public function logOut($idUser){
        // sesión valida
        
            unset($_SESSION['id_user']);
            unset($_SESSION['email']);
            unset($_SESSION['name']);
            unset($_SESSION['lName']);
            unset($_SESSION['rol']);
            unset($_SESSION['status-session']);
            session_destroy();
            echo json_encode([
                'code-response' => 1,
                'dataUser' =>null,
                'status-session' => '0'
            ]);
        
 
    }

}

?>