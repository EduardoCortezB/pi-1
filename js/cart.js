class cartProduct{
    constructor() {
        this.productList = [];
        this.iconCart=document.getElementById('iconCart');
    }
    loadStorage(){
        // cargamos los elementos a la propiedad del objetos
        this.products= (localStorage.getItem('cartProducts') != null) ? JSON.parse(localStorage.getItem('cartProducts')) : [];
    }
    getListStr(){
        return JSON.stringify(this.products);
    }

    evalCar(){
        this.loadStorage();
        let span = dom.createElement('span');
        span.className='badge badge-danger navbar-badge';
        span.id='spanNC';
        let sIc = document.getElementById('spanNC');
        if (sIc===null){ let sIc = new Object(); sIc.nodeName = 0;}
        if(this.products.length !== 0){
            if (sIc!==null) {
                document.getElementById('spanNC').textContent=this.products.length
            }else{
                span.textContent=this.products.length;
                this.iconCart.childNodes[1].append(span);
            }
        }else{
            if (sIc!==null) {
                this.iconCart.childNodes[1].removeChild(sIc)
            }
        }
    }
    isProductStorageCurrently(){
        this.loadStorage();
        if (localStorage.getItem('cartProducts') != null && this.products.length != 0) {
            return true;
        }else{
            return false;
        }
    }

    isProductStorage(idProduct){
        this.loadStorage();
        this.newIdProduct = idProduct;
        if(this.products.length!==0){
            if(this.products.find(p => p == this.newIdProduct)==this.newIdProduct){
                // existe el producto en localStorage
                return true;
            }else{
                return false;
            }
        }

    }

    addProductStorage(idProduct){
        this.loadStorage();
        this.newIdProduct = idProduct;

        if(this.products === null){
            this.productList.push(this.newIdProduct);
            localStorage.setItem('cartProducts',JSON.stringify(this.productList));
            return;
        }

        if(this.products.find(p => p === this.newIdProduct)!==this.newIdProduct){
            // no existe el producto en localStorage
            this.products.push(this.newIdProduct)
            localStorage.setItem('cartProducts',JSON.stringify(this.products))
        }
    }

    delProductSorage(idProduct){
        console.log('del Product');
        this.loadStorage();
        this.newIdProduct=null;
        this.newIdProduct = idProduct;

        if(this.products.find(p => p == this.newIdProduct)==this.newIdProduct){
            // existe el producto en localStorage
            if (this.removeItem(this.newIdProduct)) {
                
                localStorage.setItem('cartProducts',JSON.stringify(this.products))
                console.log('err-true-del-prod')
                return true;
            }else{
                console.log('err-false-del-prod')
                return false;
            }
        }else{
            console.log('err-')
        }
    }

    removeItem(item) {
        this.loadStorage();
        let i=null;
        let arrTemp = this.products;
        this.products=[];
        this.products = arrTemp.filter(function(el) {
            return el != item; 
        });
        i=null
        item=null;
        return true;
    }
}

class Order {
    loadOrderDetails(){
        this.details= (localStorage.getItem('detailsOrder') != null) ? JSON.parse(localStorage.getItem('detailsOrder')) : [];
    }

    async makeOrder(){
        this.loadOrderDetails();
        let request = new Object();
        request.proccess='1';
        request.user=localStorage.getItem('dataUser');
        request.payload=this.details 

        this.postReq(URL_SER+'dashboard/api.php?action=order&version=1',request).then(e=> {
            if (!(e === undefined)) {
                location.replace(URL_SER+'index.php?page=details_order&o='+e.order)
            }else{

                
            }
        }).catch((err) => {
            console.log(err)
            showAlert('error','A ocurrido un error');
        })
    }

    async setDetails(details_){

        this.loadOrderDetails();
        this.newDetails = [];
        this.products= (localStorage.getItem('cartProducts') != null) ? JSON.parse(localStorage.getItem('cartProducts')) : [];
        if (!(this.details.length == 0)) {
            if(!(this.details[0]!=null) || !(this.details[1].length!=0)){
                let request = new Object();
                request.proccess = '0';
                request.user=localStorage.getItem('dataUser');
                let response = await this.postReq(URL_SER+'dashboard/api.php?action=order&version=1',request)
                
                console.log('details');
                
                // localStorage.setItem('detailsOrder',JSON.stringify(this.details))
                let elemnt=[];
                let payl=[]
                for (let i = 0; i < details_.length; i++) {
                    elemnt.push(i);
                    for (let key in details_[i]) {
                        if (key=='image' || key=='name') {
                        }else{
                            payl.push([key,details_[i][key]]);
                        }
                    }
                    
                    payl.push(['qty',1]);
                    elemnt[i]=payl
                    payl=[]
                }
                
                localStorage.setItem('detailsOrder',JSON.stringify([response.idOrder,elemnt]))
                elemnt=[];
                this.getPriceTotal()
            }else{
                let elemnt=[];
                let payl=[]
                let qty=1;
                for (let i = 0; i < details_.length; i++) {
                    elemnt.push(i);
                    for (let key in details_[i]) {
                        if (key=='image' || key=='name') {
                        }else{
                            payl.push([key,details_[i][key]]);
                            try {
                                let el_= this.details[1][i][0][1]
                                if (el_ !== undefined) {
                                    if(this.details[1][i][0][1] == details_[i][key]){
                                        qty=this.details[1][i][2][1]
                                    }
                                }else{
                                    qty=1;
                                }                            
                            } catch (error) {
                                qty=1;
                            }
                        }
                    }
                    payl.push(['qty',qty]);
                    elemnt[i]=payl
                    qty=1
                    payl=[]

                }
                
                localStorage.setItem('detailsOrder',JSON.stringify([this.details[0],elemnt]))
                elemnt=[]
                this.getPriceTotal()
            }         
        }else{
            let request = new Object();
            request.proccess = '0';
            request.user=localStorage.getItem('dataUser');
            let response = await this.postReq(URL_SER+'dashboard/api.php?action=order&version=1',request)
            
            
            // localStorage.setItem('detailsOrder',JSON.stringify(this.details))
            let elemnt=[];
            let payl=[]
            for (let i = 0; i < details_.length; i++) {
                elemnt.push(i);
                for (let key in details_[i]) {
                    if (key=='image' || key=='name') {
                    }else{
                        payl.push([key,details_[i][key]]);
                    }
                }
                
                payl.push(['qty',1]);
                elemnt[i]=payl
                payl=[]
            }
            console.log(details_);
            localStorage.setItem('detailsOrder',JSON.stringify([response.idOrder,elemnt]))
            elemnt=[];    
            this.getPriceTotal()

        }
    }

    async postReq(url='',req,typeHeader={'Content-Type': 'application/json'}){
        const response = await fetch(url, {
            method: 'POST',
            headers: typeHeader,
            body: JSON.stringify(req)
        });
    
      return response.json();
    }
    updateQty(idProduct,qty){
        this.loadOrderDetails();
        this.details[1].forEach(element => {
            if(element[0][1]==idProduct){
                element[2][1]=qty
            }
        });
        let olderdetailsOrder = [];
        olderdetailsOrder[0]=this.details[0]
        olderdetailsOrder[1]=this.details[1]
        localStorage.setItem('detailsOrder',JSON.stringify(olderdetailsOrder))
    }
    getQtyProduct(idP){
        let qty = 1;
        this.loadOrderDetails();
        if (!(this.details.length === 0)) {
            this.details[1].forEach(el => {
                if (el[0][1] == idP) {
                    if(el[2][1] !== 1){
                        qty=(el[2][1])
                    }
                }  
            });       
            return qty;
        }else{
            return qty;
        }

    }

    removeElement(idProduct){
        this.loadOrderDetails();
        let arr=[]
        arr=this.details[1];
        this.details[1]=[]
        this.details[1] = arr.filter(function(el) {
            return el[0][1]!==idProduct
        });
        arr=[]
        let OlddetailsOrder = JSON.parse(localStorage.getItem('detailsOrder'));
        OlddetailsOrder[1]=this.details[1];
        localStorage.setItem('detailsOrder',JSON.stringify(OlddetailsOrder))
        OlddetailsOrder=[]
        return true;
    }

    getPriceTotal(){
        let sub = dom.getElementById('subT')
        let tot = dom.getElementById('Tot')
        let qty=0;
        let priceUnit=0;
        let total=0;

        this.loadOrderDetails();
        if (this.details.length !== 0) {
            for(let i = 0; i < this.details[1].length; i++){
                qty = parseInt(this.details[1][i][2][1]) + qty // qty
                priceUnit = parseInt(this.details[1][i][1][1])+priceUnit// price Unit
                total=qty*priceUnit+total
                qty=0;
                priceUnit=0;
            }
            if (sub !== null && tot !== null) {
                sub.textContent='$'+total
                tot.textContent='$'+total                
            }
        }
    }
}