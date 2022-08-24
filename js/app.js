const URL_SER = 'http://localhost/public_html/';
const dom = document;
const showAlert=(alert,message)=>{
    toastr[alert](message)

    toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }
}
const getRandId=()=>{
    return "file-" + Math.random().toString(23).substring(7);
}
async function postData(url = '', data = {},typeHeader={'Content-Type': 'application/json'}) {
    // 'Content-Type': 'application/x-www-form-urlencoded'
    const response = await fetch(url, {
      method: 'POST',
      headers: typeHeader,
      body: JSON.stringify(data)
    });

    return response.json();
}
const carSD = dom.getElementById('buttonCarShip');
const doOrder = dom.getElementById('nextContinue');
const cartOrder = dom.getElementById('cartOrder');
// products
dom.addEventListener('DOMContentLoaded', ()=>{
    let orderC = new Order();
    // acceso al boton del carrito
    if (carSD!==null) {
        carSD.addEventListener('click', (event) => {
            event.preventDefault()
            // validamos si hay una sesion abierta
            data=new Object();
            csrf_l='12345678';
            // data user
            data.proccess = '4';
            postData(URL_SER+'dashboard/api.php?action=request&version=1',data).then((response) => {
                if(response['estatus'] === 'ok'){
                    location.replace(URL_SER+'page/car_shopping'); 
                }else{
                    location.replace(URL_SER+'page/necesitasInicarSesion');
                }
            })
        })
    }

    isLog()
    // initialize the categories menu
    initCategories();

    // initialize menu products
    initProducts();
    // car icon 
    carShipping()
    
    if (cartOrder!==null) {
        initOrder();
        orderC.getPriceTotal();
        for(let i=0; i < dom.getElementsByTagName('input').length; i++){
            console.log(dom.getElementsByTagName('input')[i])
        } 

        if (doOrder !== null) {
            doOrder.addEventListener('click', (e) => {
                e.preventDefault();
                orderC.makeOrder();
            })
        }        
    }

    
});
initOrder= async ()=>{
    let req_det = new Object();
    req_det.proccess = '4'; // check detail active
    req_det.idUser = localStorage.getItem('dataUser'); // user

    // validar si hay una orden activa.
    let isOrderDetails= await postData(URL_SER+'dashboard/api.php?action=order&version=1',req_det);

    if (!(isOrderDetails.status == undefined)) {
        let orderC = new Order();
        var cartC = new cartProduct();
        // Evaluar si no hay productos en el localStorage
        if(cartC.isProductStorageCurrently()){
            let products= await getProductsCart(URL_SER+'dashboard/api.php?action=upload&version=1',cartC.getListStr());
            // renderizamos los datos en la tabla de ordenes
            let tableProduct = dom.querySelector('table').childNodes[3];
            let orderDetails = new Order()
            if (tableProduct!=null) {
                orderDetails.setDetails(products)
                for(let i=0; i < products.length; i++){
                    tableProduct.appendChild(tbleProduct(products[i]));
                }      
            }
        }else{
            const shoppingArea = dom.getElementById('sectionShoppingCar');
            shoppingArea.innerHTML='<div class="alert alert-warning" role="alert">Vaya!, Aún no hay productos seleccionados para realizar una orden.</div>'
        } 
    }else{
        // redirigimos a details order
        location.replace(URL_SER+'index.php?page=details_order&o='+isOrderDetails.order)
    }
}
isLog=()=>{
    data=new Object();
    csrf_l='sakdmsiwld23k4_';
    data.proccess = '4';

    postData(URL_SER+'dashboard/api.php?action=request&version=1',data).then((response) => {
        if(response['estatus'] === 'ok'){
            // active session

        }else if (response['estatus'] === 'nel') {
            localStorage.clear()
        }
    }).catch(err=>{
        showAlert('error', 'A ocurrido un problema.')
    })
}
tbleProduct = (product)=>{

    let idProduct = product.idProduct;
    let cartP= new cartProduct();
    let tmpl = dom.getElementById('cart-section');
    let cart = document.importNode(tmpl.content, true)
    let OrderC = new Order();
    let tdElements = cart.querySelectorAll('td');
    let tr = cart.querySelector('tr');
    tdElements[0].childNodes[1].src=URL_SER+'img/products/'+product.image;
    tdElements[0].childNodes[3].textContent=product.name;
    tdElements[1].textContent='$'+product.priceUnit;
    
    let input = cart.getElementById('inpProd')
    
    if (OrderC.getQtyProduct(idProduct) !== 1) {
        let qtyP = OrderC.getQtyProduct(idProduct)
        input.value=qtyP;
        tdElements[3].textContent = '$'+(qtyP*product.priceUnit);
    }else{
        tdElements[3].textContent = '$'+product.priceUnit;
    }

    // Sumamos la cantidad del producto a la orden
    cart.getElementById('addItem').onclick = ()=>{
        if(!Number.isInteger(parseInt(input.value)) || parseInt(input.value)<1){
            input.value=1
            OrderC.updateQty(idProduct,parseInt(1))
            tdElements[3].textContent = '$'+product.priceUnit;
            OrderC.getPriceTotal();
        }else{
            input.value = parseInt(input.value) + 1;
            
            OrderC.updateQty(idProduct,parseInt(input.value))
            // modificar el valor del h5
            tdElements[3].textContent = '$'+parseInt(input.value) * parseInt(product.priceUnit);
            OrderC.getPriceTotal();
        }

    };

    // Restamos la cantidad del producto a la orden
    cart.getElementById('substractItem').onclick = ()=>{
        if(parseInt(input.value) === 1){
            input.value = 1;
            
            OrderC.updateQty(idProduct,parseInt(1))
            // modificar el valor del h5
            tdElements[3].textContent = '$'+product.priceUnit;
            OrderC.getPriceTotal();
        }else{
            if(!Number.isInteger(parseInt(input.value)) || parseInt(input.value)<1){
                input.value=1
                OrderC.updateQty(idProduct,parseInt(1))
                tdElements[3].textContent = '$'+parseInt(product.priceUnit);
                OrderC.getPriceTotal();
            }else{
                input.value = parseInt(input.value) - 1;
                OrderC.updateQty(idProduct,parseInt(input.value))
                // modificar el valor del h5
                tdElements[3].textContent = '$'+(parseInt(tdElements[3].textContent.replace('$', '')) - parseInt(product.priceUnit)).toString();
                OrderC.getPriceTotal();
            }    
        }
    };
    
    // eliminamos el producto de la orden
    cart.getElementById('removeProduct').onclick= ()=>{
        let orderC = new Order();
        orderC.removeElement(idProduct)
        if(cartP.delProductSorage(idProduct)=== true){

            cartP.evalCar();
            tr.remove();
            OrderC.getPriceTotal();
            if(JSON.parse(cartP.getListStr()).length === 0){
                const shoppingArea = dom.getElementById('sectionShoppingCar');
                shoppingArea.innerHTML='<div class="alert alert-warning" role="alert">Vaya!, Aún no hay productos seleccionados para realizar una orden.</div>'
            }
        }else{
            console.log('del prod from database')
            showAlert('error', 'a ocurrido un problema al eliminar el producto');
        }
    }

    return cart;

}

carShipping=()=>{
    let cart= new cartProduct();
    cart.evalCar();
}
// boton para agregar y eliminar productos al carrito
addCart=(e)=>{

    let cart= new cartProduct();
    let order_= new Order();
    // obtenemos la id del producto
    let idProduct = e.target.parentNode.parentNode.parentNode.childNodes[3].value;

    if (e.target.className === 'genric-btn primary-border') {
        // validamos si hay una sesion abierta
        data=new Object();
        csrf_l='12345678';
        // data user
        data.proccess = '4';
        postData(URL_SER+'dashboard/api.php?action=request&version=1',data).then((response) => {
            if(response['estatus'] === 'nel'){
                location.replace(URL_SER+'page/necesitasInicarSesion');
                return; 
            }else{
                // producto añadido
                cart.addProductStorage(idProduct);
                e.target.textContent='Añadido';
                e.target.className ='genric-btn primary';
                cart.evalCar();
                return;
            }
        })
    }

    if (e.target.className === 'genric-btn primary') {
        // quitar producto
        cart.delProductSorage(idProduct);
        e.target.textContent='Añadir';
        e.target.className ='genric-btn primary-border'; 
        cart.evalCar();
        return;
    }

}

const getProductsCart = async (url='',listProducts) => {
    let request = new FormData();
    request.append('proccess', 'get-products-cart');
    request.append('list', listProducts);

    try {
      let response = await fetch(url, {
          method: 'POST',
           body: request
      });
  
        let data = await response.json();
        return data;
    } catch (e) {
      showAlert('error','500. A ocurrido un error.');
    }
}
const getProducts = async (url='',idCategory=null) => {
  let request = new FormData();
  request.append('proccess', 'get-products');
  
  if (idCategory !== null) {
    request.append('idProduct', idCategory);
  }  
  try {
    let response = await fetch(url, {
        method: 'POST',
         body: request
    });

      let data = await response.json();
      return data;
  } catch (e) {
    showAlert('error','500. A ocurrido un error.');
  }
}

const getCategories = async (url='') => {
  let request = new FormData();
  request.append('proccess', 'get-categories');

  try {
    let response = await fetch(url, {
        method: 'POST',
         body: request
      });

      let data = await response.json();
      return data;
  } catch (e) {
    showAlert('error','500. A ocurrido un error.');
  }
}

initProducts = async (idCategory=null) =>{
    
    let req_det = new Object();
    req_det.proccess = '4'; // check detail active
    req_det.idUser = localStorage.getItem('dataUser'); // user

    // validar si hay una orden activa.
    let isOrderDetails= await postData(URL_SER+'dashboard/api.php?action=order&version=1',req_det);

    const divListP = dom.getElementById('list-products');
    if (divListP!==null) {
        if (idCategory === null) {
        
            // get data of products
            divListP.innerHTML='';
            getProducts(URL_SER+'dashboard/api.php?action=upload&version=1').then(data=>{
                if (data == false){
                    showAlert('error', 'Se a producido un error.');
                }else{
                    data.forEach(product => {
                        divListP.appendChild(productV(product,isOrderDetails));
                    });
                }
            })
        }else{
            // get data of products by category
            divListP.innerHTML='';
            getProducts(URL_SER+'dashboard/api.php?action=upload&version=1',idCategory).then(data=>{
                if (data.length===0) {
                    divListP.appendChild(productV('empty',isOrderDetails));
                }else{
                    if (data == false){
                        showAlert('error', 'Se a producido un error.');
                    }else{
                        data.forEach(product => {
                            divListP.appendChild(productV(product,isOrderDetails));
                        });
                    }
                }
            }) 
        }
    }

}

initCategories= async (idCat=null) =>{
    const divCategories = dom.getElementById('categorias');
    if (divCategories!==null) {
        divCategories.innerHTML='';
        if (idCat == null) {
            if (divCategories !== null) {
                divCategories.appendChild(buttonCat('Todo','all','all'))
        
                // get all categories
                let listCategories=await getCategories(URL_SER+'dashboard/api.php?action=upload&version=1');
        
                for (var i = 0; i < listCategories.length; i++) {
                    divCategories.appendChild(buttonCat(listCategories[i][1],listCategories[i][0]))
                }
            }
        }else{
    
            if (divCategories !== null) {
                divCategories.appendChild(buttonCat('Todo','all',idCat))
        
                // get all categories
                let listCategories=await getCategories(URL_SER+'dashboard/api.php?action=upload&version=1');
        
                for (var i = 0; i < listCategories.length; i++) {
                    divCategories.appendChild(buttonCat(listCategories[i][1],listCategories[i][0],idCat))
                }
            }
        }      
    }

}

buttonCat = (nameC,idC,idCS=null) =>{
    if (idCS === idC) {
        let btn=dom.createElement('button');
        btn.type='submit';
        btn.className='btn btn-outline-danger p-3 m-1 active';
        btn.value=idC;
        btn.textContent=nameC;
        btn.onclick=buttonEvent;
        return btn;      
    }else{
        let btn=dom.createElement('button');
        btn.type='submit';
        btn.className='btn btn-outline-danger p-3 m-1';
        btn.value=idC;
        btn.textContent=nameC;
        btn.onclick=buttonEvent;
        return btn;    
    }
   
}

buttonEvent = (e) =>{
    if(e.target.value ==  'all'){
        // initialize the categories menu
        initCategories();
        // initialize menu products
        initProducts();
    }else{
        initCategories(e.target.value) // mostramos el menu de categorias con la categoria elegida
        initProducts(e.target.value)
    }
}

productV= (product,isOrder) =>{

    if (!(isOrder.order === undefined)) {
        isOrder=false;
    }
    if (product === 'empty') {
        let d = dom.createElement('div')
        d.className='alert alert-light'
        d.role='alert'
        d.textContent='No hay productos aun.';
        
        return d;
    }else{
        let idProd = product.idProduct;
        let cart= new cartProduct();

        let tmpl = dom.getElementById('tp-product');
        let productT = document.importNode(tmpl.content, true)
        // image
        productT.querySelectorAll('div')[2].childNodes[1].src=URL_SER+'img/products/'+product.image
        // price
        productT.querySelectorAll('div')[3].childNodes[1].textContent=product.priceUnit
        //name product
        
        productT.querySelectorAll('div')[4].childNodes[1].childNodes[0].href=URL_SER+'viewProduct/'+idProd;
        productT.querySelectorAll('div')[4].childNodes[1].childNodes[0].textContent=product.name
        productT.querySelectorAll('div')[4].childNodes[3].textContent=product.description;//p
        productT.querySelectorAll('input')[0].value=idProd;
        //evaluamos si el hay una orden activa
        if (isOrder) {
            if(cart.isProductStorage(idProd)){
                productT.querySelectorAll('div')[4].childNodes[5].className='genric-btn primary';// this product is already in the cart
                productT.querySelectorAll('div')[4].childNodes[5].textContent='Añadido';
                productT.querySelectorAll('div')[4].childNodes[5].onclick=addCart;//button
            }else{
                productT.querySelectorAll('div')[4].childNodes[5].className='genric-btn primary-border'
                productT.querySelectorAll('div')[4].childNodes[5].textContent='Añadir';
                productT.querySelectorAll('div')[4].childNodes[5].onclick=addCart;//button
            }
        }else{
            productT.querySelectorAll('div')[4].childNodes[5].className='genric-btn primary';
            productT.querySelectorAll('div')[4].childNodes[5].disabled=true
            productT.querySelectorAll('div')[4].childNodes[5].textContent='No accion';
            // productT.querySelectorAll('div')[4].childNodes[5].onclick=addCart;//button
        }
        
        return productT;
    }
}
