const lOut = dom.getElementById('closeSesion');

dom.addEventListener('DOMContentLoaded', (e) => {


    const frm_l = dom.getElementById('login');
    //login
    if (frm_l !== null) {
        frm_l.addEventListener('submit',(e) =>{
            e.preventDefault();
            let eml_l = dom.getElementById('eml').value;
            let pwd_l = dom.getElementById('pwd').value;
            let csrf_l = dom.getElementById('csrf_t').value;
            let data = {}
            // validamos campos
            if(valid_data_l(eml_l,pwd_l)){
                // campos llenos
                data.proccess = '1';
                data.mail = eml_l;
                data.pwd = pwd_l;
                data.csrf = csrf_l;
                postData(URL_SER+'dashboard/api.php?action=request&version=1',data).then(data=>{
                    // console.log(data);
                    if(data['code-response'] == 0){
                        showAlert('error', 'Correo electronico ó contraseña incorrectos.');
                    }
                    if (data['code-response'] == 1) {
                        // session ok
                        showAlert('success', 'Haz accedido correctamente. Redirigiendo...');

                        localStorage.setItem('dataUser', data['dataUser'].idUser);
                        setTimeout(function(){
                            location.href=URL_SER;
                        },1500);
                    }
                    if (data['code-response'] == 2) {
                        showAlert('error', '505 ERR-Query_Error interno de servidor.');
                    }
                    if (data['code-response'] == 3) {
                        showAlert('error', 'Todos los campos son obligatorios');
                    }
                }).catch(err => {
                    showAlert('error', '500 Crch Error interno de servidor.');
                })

            }else{
                showAlert('error', 'Todos los campos son obligatorios');
            }
        })
    }

    const frm_r = dom.getElementById('register-form');

    if (frm_r !== null) {
        frm_r.addEventListener('submit', (e)=>{
            e.preventDefault();
            var request = new Object();
            request.proccess = '2';
            request.fName = dom.getElementById('fName').value;
            request.lName = dom.getElementById('lName').value;
            request.number = dom.getElementById('number').value;
            request.email = dom.getElementById('email').value;
            request.pwd1 = dom.getElementById('pwd1').value;
            request.pwd2 = dom.getElementById('pwd2').value;

            if (valid_data_r) {
                if (request.pwd1 === request.pwd2) {

                    postData(URL_SER+'dashboard/api.php?action=request&version=1',request).then(data => {
                        if (data['code-response'] == 0) {
                            showAlert('success', 'Se ha registrado correctamente');
                            setTimeout(function(){
                                location.href=URL_SER
                            })
                        }
                        if (data['code-response'] == 1) {
                            showAlert('error', 'A ocurrido un error al registrar al usuario');
                        }
                        if (data['code-response'] == 2) {
                            showAlert('info', 'El usuario se encuentra registrado con este email '+request.email);
                        }
                    }).catch(err => {
                        showAlert('error', '505. Error interno.');
                    })
                }else{
                    showAlert('error', 'Las contraseñas no coinciden.');
                }

            }else{
                showAlert('error', 'Todos los campos son obligatorios.');
            }

        })
    }


    valid_data_l=(usr_,pwd_)=>{
        if (usr_ !== '' && pwd_ !== '') {
            return true;
        }else{
            return false;
        }
    }

    valid_data_r=(fName_,lName_,nmbr_,eml_,pwd1_,pwd2_)=>{
        if (fName_ !== '' && lName_ !== '' && nmbr_ !== '' && eml_ !== ''&& pwd1_ !== ''&& pwd2_ !== '') {
            return true;
        }else{
            return false;
        }
    }

    showPwd1=()=>{
        var inptPwd = dom.getElementById('pwd');
        if (inptPwd.type=='password') {
            inptPwd.type='text';
            return;
        }
        if (inptPwd.type=='text') {
            inptPwd.type='password';
            return;
        }
    }

    showPwd2=()=>{
        var inptPwd1 = dom.getElementById('pwd1');
        var inptPwd2 = dom.getElementById('pwd2');
        if (inptPwd1.type=='password') {
            inptPwd1.type='text';
        }
        if (inptPwd2.type=='password') {
            inptPwd2.type='text';
            return;
        }
        if (inptPwd1.type=='text') {
            inptPwd1.type='password';
        }
        if (inptPwd2.type=='text') {
            inptPwd2.type='password';
            return;
        }
    }

});
if (lOut !== null) {
    lOut.addEventListener('click', ()=>{
        data=new Object();
        csrf_l='12345678';
        // data user
        data.proccess = '3';
        data.idUser = localStorage.getItem('dataUser'); // user id
        data.csrf = csrf_l;
        postData(URL_SER+'dashboard/api.php?action=request&version=1',data).then(data => {
            if (data['code-response'] == 1) {
                localStorage.clear()
                showAlert('info', 'Se a cerrado la sesión correctamente.');
                setTimeout(function(){
                    location.href=URL_SER;
                },1000);
            }
        }).catch(err => {
            showAlert('error', 'Se a producido un problema al cerrar la sesión');
        })
    })

}