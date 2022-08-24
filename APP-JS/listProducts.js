function delElement(e) {
  id = e.target.parentElement.childNodes[2].value

  // $('#myModal').modal('show')
  const edithModal = new bootstrap.Modal(dom.getElementById('myModal'), {
    keyboard: false
  });
  edithModal.show();
  let btn_del_product = document.getElementById('okDel');
  let dataRequest = new FormData()

  dataRequest.append("proccess", 'delProduct');
  dataRequest.append("id", id);

  // eliminamos producto
  btn_del_product.addEventListener('click', () => {
    fetch(URL_SER + 'dashboard/api.php?action=upload&version=1&action=delProduct&id='+id, {
      method: 'DELETE',
      // body: dataRequest
    }).then(res => res.json()).then(data => {
      console.log(data)
      showAlert('success', 'Se a eliminado el producto exitosamente.');
      rendListProductsTable()
    })
  })
}

function rendListProductsTable() {
  const table = document.getElementById('listProd_');
  
  fetch(URL_SER + 'dashboard/api.php?action=upload&version=1&action=get-products', {
    method: 'GET',
  }).then(resp => resp.json()).then(data => {
    table.innerHTML = "";
    // renderize body of the table
    data.forEach(element => {

      let tr = document.createElement('tr');
      tr.addClass = 'table-row'


      let th1 = document.createElement('th');
      th1.innerHTML = element.idProduct
      tr.append(th1)
      let th2 = document.createElement('th');
      th2.innerHTML = element.name
      tr.append(th2)
      let th3 = document.createElement('th');
      th3.innerHTML = element.description
      tr.append(th3)
      let th4 = document.createElement('th');
      th4.innerHTML = '$'+element.priceUnit
      tr.append(th4)
      // imagen
      let img = document.createElement('img');
      let th5 = document.createElement('th');
      img.src = URL_SER + 'img/products/' + element.image
      img.height = 150
      img.width = 150
      th5.append(img)
      tr.append(th5)

      let th6 = document.createElement('th');

      //boton modificar
      let btn1 = document.createElement('button');
      btn1.classList = 'btn btn-primary'
      btn1.innerText = 'Modificar'
      btn1.onclick = btnModify
      th6.append(btn1)

      // boton eliminar
      let btn2 = document.createElement('button');
      btn2.classList = 'btn btn-danger'
      btn2.innerText = 'Eliminar'
      btn2.onclick = delElement
      th6.append(btn2)

      let inpt = document.createElement('input')
      inpt.type = 'hidden'
      inpt.value = element.idProduct
      th6.append(inpt)
      tr.append(th6)


      table.appendChild(tr)
    });
    // to use datatable
    $('#tableProducts').DataTable();
  })

}
if (dom.getElementById('listProd_') !== null) {
  rendListProductsTable()
}