function btnHechoOrder(e){
    idOrder = e.target.parentElement.childNodes[0].value
    fetch('http://localhost/public_html/app-php/okOrder.php?id='+idOrder, {
        method: 'GET',
      }).then(resp => resp.json()).then(data => {
          if (data.success=='ok') {
            showAlert('success', data.message);
            setTimeout(listOrdersDone(), 2000);
          }
      })

}
function listOrdersDone() {
    const listOrders = document.getElementById('orderList')
    fetch('http://localhost/public_html/app-php/list.php?filter=2', {
        method: 'GET',
      }).then(resp => resp.json()).then(data => {
        listOrders.innerHTML = "";
    // renderize body of the table
    data.forEach(element => {
        if (element.statusNotify=='2') {
            let tr = document.createElement('tr');
        tr.addClass = 'table-row'


        let th1 = document.createElement('th');
        if (element.statusNotify == '1') {
            th1.innerHTML = '<p class="text-danger">Pendiente</p>'
        }
        if (element.statusNotify == '2') {
            th1.innerHTML = '<p class="text-success">Hecha</p>'
        }
        tr.append(th1)
        let th2 = document.createElement('th');
        th2.innerHTML = element.idOrder
        tr.append(th2)
        let th3 = document.createElement('th');
        th3.innerHTML = element.name + ' ' +element.lastName
        tr.append(th3)
        let th4 = document.createElement('th');
        th4.innerHTML = element.email
        tr.append(th4)
        let th5 = document.createElement('th');
        th5.innerHTML = element.dateShipping
        tr.append(th5)
        let th6 = document.createElement('th');
        th6.innerHTML = element.dateDelivery
        tr.append(th6)
        let th7 = document.createElement('th');
        th7.innerHTML = '$'+element.total
        tr.append(th7)
            // acciones
        let th8 = document.createElement('th');

        let inpt = document.createElement('input')
        inpt.type = 'hidden'
        inpt.value = element.idOrder
        th8.append(inpt)

        //boton ver
        let btn1 = document.createElement('a');
        btn1.classList = 'btn btn-primary'
        btn1.innerText = 'Ver'
        btn1.href = URL_SER + 'dashboard/index.php?page=view_order&order='+element.idOrder;
        th8.append(btn1)
        tr.append(th8)

        listOrders.appendChild(tr)
        }
    });

      })   
}

function listOrdersPending() {

    const listOrders = document.getElementById('orderList')
    fetch('http://localhost/public_html/app-php/list.php?filter=1', {
        method: 'GET',
      }).then(resp => resp.json()).then(data => {
        listOrders.innerHTML = "";
    // renderize body of the table
    data.forEach(element => {
        
        let tr = document.createElement('tr');
        tr.addClass = 'table-row'


        let th1 = document.createElement('th');
        if (element.statusNotify == '1') {
            th1.innerHTML = '<p class="text-danger">Pendiente</p>'
        }
        if (element.statusNotify == '2') {
            th1.innerHTML = '<p class="text-success">Hecha</p>'
        }
        tr.append(th1)
        let th2 = document.createElement('th');
        th2.innerHTML = element.idOrder
        tr.append(th2)
        let th3 = document.createElement('th');
        th3.innerHTML = element.name + ' ' +element.lastName
        tr.append(th3)
        let th4 = document.createElement('th');
        th4.innerHTML = element.email
        tr.append(th4)
        let th5 = document.createElement('th');
        th5.innerHTML = element.dateShipping
        tr.append(th5)
        let th6 = document.createElement('th');
        th6.innerHTML = element.dateDelivery
        tr.append(th6)
        let th7 = document.createElement('th');
        th7.innerHTML = '$'+element.total
        tr.append(th7)
            // acciones
        let th8 = document.createElement('th');

        let inpt = document.createElement('input')
        inpt.type = 'hidden'
        inpt.value = element.idOrder
        th8.append(inpt)

        // boton ver
        let btn2 = document.createElement('a');
        btn2.classList = 'btn btn-primary'
        btn2.innerText = 'Ver'
        btn2.href = URL_SER + 'dashboard/index.php?page=view_order&order='+element.idOrder;
        th8.append(btn2)

        //boton hecho
        let btn1 = document.createElement('button');
        btn1.classList = 'btn btn-success'
        btn1.innerText = 'Hecho'
        btn1.onclick = btnHechoOrder
        th8.append(btn1)
        tr.append(th8)

        listOrders.appendChild(tr)
    });

      })   
}


