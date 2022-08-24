const inputDate =  dom.getElementById('date');

const makeOrder = dom.getElementById('makeOrder');
const deleteOrder = dom.getElementById('deleteOrder');
const idOrder = dom.getElementById('order');

const cpp = dom.getElementById('cpp');
const address = dom.getElementById('address');
const idUser = dom.getElementById('idUser');
const date = dom.getElementById('date');



dom.addEventListener('DOMContentLoaded',()=>{
    var fecha = new Date();
    var anio = fecha.getFullYear();
    var dia = fecha.getDate();
    var _mes = fecha.getMonth();//viene con valores de 0 al 11
    _mes = _mes + 1;//ahora lo tienes de 1 al 12
    if (_mes < 10)//ahora le agregas un 0 para el formato date
    { var mes = "0" + _mes;}
    else
    { var mes = _mes.toString();}

    inputDate.min = anio+'-'+mes+'-'+dia;


    makeOrder.addEventListener('click', async ()=>{
        if(idOrder.value !=='' && address.value !== '' 
        && date.value !== ''
        && cpp.value !== '' && idUser.value !== '' && total.value !== ''){
            
            // send order
            let req = new Object();
            req.proccess='5';
            req.order=idOrder.value;
            req.address=address.value;
            req.cpp=cpp.value;
            req.idUser=idUser.value;
            req.date=date.value;
            req.total=total.value;
            
            let response = await postData(URL_SER+'dashboard/api.php?action=order&version=1',req);
            if (response.response == 'ok') {
             
                showAlert('success', 'Se ha realizado la orden');

                setTimeout(function(){
                    localStorage.setItem('cartProducts',JSON.stringify([]));
                    localStorage.setItem('detailsOrder',JSON.stringify([[],[]]));   
                },1500)
                setTimeout(function(){ 
                    location.replace(URL_SER+'index.php?page=order_ok&o='+idOrder.value);
                },2000)
            }else{
                showAlert('error', 'A ocurrido un error');
            }

        }else{
            showAlert('error', 'Todos los campos son obligatorios');
        }

    })

})

