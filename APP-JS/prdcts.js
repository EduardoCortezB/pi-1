
const addChanges =()=> { return  dom.getElementById('addEdith'); } // boton para confirmar la informacion
const modalEdith =()=> { return dom.getElementById('modalEdit');} // detectamos el modal para editar
if (addChanges() !== null) {
    addChanges().addEventListener('click',()=> {
        
        let updateProductInfo = new Object();
        
        updateProductInfo.name = dom.getElementById('productMod');
        updateProductInfo.idCategory = dom.getElementById('categoryEdith');
        updateProductInfo.id = dom.getElementById('previewImgEdit').childNodes[1].textContent;
        updateProductInfo.description = dom.getElementById('productDesc');
        updateProductInfo.price = dom.getElementById('productPrice');
        updateProductInfo.idCurrentProduct = dom.getElementById('idCurrentProduct');
        updateProductInfo.file = getInp();
        updateProductInfo.isFile = updateProductInfo.file.files.length;

        if(valInptM(updateProductInfo)){
            updateProduct(URL_SER, updateProductInfo, updateProductInfo.id).then(data=>{
                if (data.statusProccess === 'ok') {
                    showAlert('success','Se ha modificado el producto exitosamente.')
                    window.location.href = "#";

                    var myModalEl = modalEdith()
                    var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)
                    modal.hide()

                    rendListProductsTable()
                    // setTimeout(function(){
                    //     window.location.href = URL_SER+"dashboard/index.php?page=list";
                    // },2000);
                }else{
                    window.location.href = "#alerts";
                    showAlert('error','A ocurrido un problema, vuelve a intentarlo')
                }
            }).catch(err=>{
                console.log(err)
                showAlert('error','505. A ocurrido un error al subir la modificación');
            })
        }
    });
}


const valInptM = (product)=>{
    // validamos que todos los campos esten correctos

    if (product.name.value.length !== 0 &&
        product.description.value.length !== 0 &&
        product.price.value.length !== 0) {

        return true;

    }else{
        showAlert('error','Todos los campos son obligatorios...')
    }
}
const btnModify = (e)=>{
    idPoroduct=e.target.parentElement.childNodes[2].value
    // constantes de elementos del dom
    let modCont = modalEdith().childNodes[1].childNodes[1].childNodes[3]; // div de contenido

    const edithModal = new bootstrap.Modal(modalEdith(), {
        keyboard: false
    });
    
    // consultamos a la base de datos la informacion de los productos
    getInfoProduct(URL_SER+'dashboard/api.php?action=upload&version=1',idPoroduct).then(dataJson=>{
        getInfocategories(URL_SER+'dashboard/api.php?action=upload&version=1').then(dataCategory=>{
            showModal(edithModal,modCont,dataJson,dataCategory);
            sysFile();
        })
    }).catch(err=>{
        console.error(err);
    })

}
const sysFile = ()=>{
    let previewEdit = dom.getElementById('previewImgEdit');
    let inputFile = getInp();
    inputFile.addEventListener('change',()=> {
        let fileData = inputFile.files[0];
        // getRandId()
        validateFile(fileData,getRandId(),alrtEdith(),previewEdit);
    });
}

const getInp=()=>{
    return dom.getElementById('imageNewProduct');
}

const alrtEdith=()=>{
    return dom.getElementById('alertMEdit');
}
const showModal = (edithModal,modCont, dataProduct, dataCategory)=> {
    edithModal.show();
    let modContH = `
    <div id="alertMEdit"></div>
    <h5>Categoria</h5>
    <form enctype="multipart/form-data" method="post" id="formEdit">
        <div class="mb-3 form-group">
            <select class="form-select" name="categoryEdith" id="categoryEdith" aria-label="selectCategory">
                ${showCategoryU(dataCategory,dataProduct.idCategory)}
            </select>
        </div>
        <hr>
        <h5>Nombre del producto</h5>
        <div class="mb-3 form-group">
            <input type="text" name="productMod" id="productMod" class="form-control" value="${dataProduct.name}">
        </div>
        <hr>
        <h5>Descripción</h5>
        <div class="mb-3 form-group">
            <textarea required name="productDesc" id="productDesc" class="form-control">${dataProduct.description}</textarea>
        </div>
        <hr>
        <h5>Precio</h5>
        <div class="mb-3 form-group">
            <input type="number" name="productPrice" id="productPrice" class="form-control" value="${parseInt(dataProduct.priceUnit)}">
        </div>
        <hr>
        <input type="hidden" name="idCurrentProduct" id="idCurrentProduct" value="${parseInt(dataProduct.idProduct)}">
        <h5>Imágen del producto</h5>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-cloud-upload-alt text-center"></i></span>
            <input type="file" required id="imageNewProduct" name="fileImage">
        </div>
        <div class="text-center" id="previewImgEdit">
            <img src="${URL_SER}img/products/${dataProduct.image}" class="img-thumbnail" width="250px">
        </div>
    </form>
        `;
    modCont.innerHTML=modContH;
}

const showCategoryU=(dataCategory,idCategory)=>{
    let options='';
    dataCategory.forEach(category => {
        if(parseInt(category[0])===parseInt(idCategory)){
            options+=`<option selected value="${category[0]}">${category[1]}</option>`;
        }else{
            options+=`<option value="${category[0]}">${category[1]}</option>`;
        }
    });

    return options;
}

const getInfoProduct = async (url='',idProduct) => {
  let request = new FormData();
  request.append('proccess', 'get-product');
  request.append('idPoroduct', idProduct);

  try {
    let response = await fetch(url, {
        method: 'POST',
         body: request
      });

      let data = await response.json();
      return data;
  } catch (e) {
    showAlert('error','505. A ocurrido un error.');
  }
}


const getInfocategories = async (url='') => {
    let request = new FormData();
    request.append('proccess', 'get-categories');

    let response = await fetch(url, {
        method: 'POST',
         body: request
      });

      let data = await response.json();
      return data;
}
updateProduct = async (url='',product,id)=>{
    let request = new FormData();
    request.append('proccess', 'update-product');
    request.append('csrf_t', '0');
    request.append('idOldImg', product.idCurrentProduct.value);
    request.append('nameProduct', product.name.value);
    request.append('categoryProduct', product.idCategory.value);
    request.append('descProduct', product.description.value);
    request.append('priceProduct', product.price.value);
    request.append('isFile', product.isFile);
    request.append('imgProduct', product.file.files[0]);
    request.append('nameImg', id);

    let response = await fetch(url+"dashboard/api.php?action=upload&version=1", {
        method: 'post',
        body: request
    })
    let data = await response.json();
    return data;
}

async function postData(url = '', data = {}) {
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            // 'Content-Type': 'application/x-www-form-urlencoded'
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    return response.json();
}
// CLOSE SESION
const lOut = dom.getElementById('closeSesion');
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

