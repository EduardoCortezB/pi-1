var product= new Object();

product.nameProduct = dom.getElementById('nameProduct');
product.descProduct = dom.getElementById('description');
product.pricProduct = dom.getElementById('priceUnit');
product.fileInput = dom.getElementById('imageProduct');
product.idCategory = dom.getElementById('category');
// product.id = id;
const altrt = dom.getElementById('alerts');

var allR = true;



dom.addEventListener('DOMContentLoaded', ()=>{

    const preview_ = dom.getElementById('preview');
    
    const modalConf = dom.getElementById('modalConf');
    const conf = dom.getElementById('confirmation');
    const addInfConf = dom.getElementById('addInfoOk');
    
    
    dom.getElementById('imgf').addEventListener('click', (e)=>{
        product.fileInput.click();
    })
    // if a changued detected had validated a file
    product.fileInput.addEventListener('change', (e) =>{
        validateFile(product.fileInput.files[0],getRandId(),altrt,preview_);
    });

    conf.addEventListener('click', (e) => {
        const myModal = new bootstrap.Modal(modalConf, {
            keyboard: false
        });

        // validamos para mostrar el modal
        if (validateInp(altrt) && allR === true) {
            myModal.show();
            let modCont = modalConf.childNodes[1].childNodes[1].childNodes[3];

            let imgbase64 = preview_.childNodes[0].src;

            let modContH = `
            <h5>Nombre del producto</h5>
            <p>${product.nameProduct.value}</p>
            <hr>
            <h5>Descripción</h5>
            <p>${product.descProduct.value}</p>
            <hr>
            <h5>Precio</h5>
            <p>$${product.pricProduct.value}</p>
            <hr>
            <h5>Imágen del producto</h5>
            <div class="text-center">
                <img src="${imgbase64}" class="img-thumbnail" width="300px">
            </div>
            `;

            modCont.innerHTML=modContH;
        }
    })

    addInfConf.addEventListener('click', (event) =>{
        // extraemos el archivo
        let file = product.fileInput.files[0];
        // validamos y enviamos
        sndInf(product,getRandId())
        myModal.hide();

    });
});

validateInp = (alt)=>{
    // validamos que todos los campos esten correctos

    if (product.fileInput.value.length !== 0 &&
        product.nameProduct.value.length !== 0 &&
        product.descProduct.value.length !== 0 &&
        product.pricProduct.value.length !== 0) {

        return true;

    }else{
        showAlert('error','Todos los campos son obligatorios...')
    }
}

validateFile = (file,id,alt,preview) => {
    const imgType = file.type;
    const validExt = ['image/png', 'image/jpg', 'image/gif', 'image/jpeg'];
    const reader = new FileReader();


    const vImg = dom.createElement('img');
    vImg.className='img-thumbnail';
    vImg.width=300;
    const textImg = dom.createElement('p');


    if (validExt.includes(imgType)) {
        alt.innerHTML = '';
        allR = true;
        reader.onloadend= ()=>{
            preview.innerHTML = '';
            vImg.src = reader.result;
            textImg.textContent=id;
            preview.className='p-4 text-center';
            preview.appendChild(vImg);
            preview.appendChild(textImg);
        }
        reader.readAsDataURL(file);
    }else{
        showAlert('error','Formato de imagen no valido, solo imagenes.')
        allR = false;
    }
}

sndInf = (product,id)=>{
    let formData = new FormData();
    formData.append('proccess', 'add-product');
    formData.append('csrf_t', '0');
    formData.append('nameProduct', product.nameProduct.value);
    formData.append('categoryProduct', product.idCategory.value);
    formData.append('descProduct', product.descProduct.value);
    formData.append('priceProduct', product.pricProduct.value);
    formData.append('imgProduct', product.fileInput.files[0]);
    formData.append('nameImg', id);
    
    fetch(URL_SER+"dashboard/api.php?action=upload&version=1", {
        method: 'POST',
        body: formData,
    })
    .then(respuesta => respuesta.text())
    .then(decodificado => {
        let dataInf = JSON.parse(decodificado);
        
        if (dataInf.statusProccess === 'ok') {
                showAlert('success','Se ha hecho el registro. <br> Redirigiendo en 2 segundos...')
                window.location.href = "#alerts";
                setTimeout(function(){
                   window.location.href = URL_SER+"dashboard/index.php?page=list";
                },1000);
            }else{
                window.location.href = "#alerts";
                showAlert('error','A ocurrido un problema, vuelve a intentarlo')
            }
        }).catch(err=>{
          showAlert('error','500. A ocurrido un problema')
        });
}
