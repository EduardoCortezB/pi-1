<?php 
$alertaUsr='';


?>
<!-- breadcam_area_start -->
<div class="opacity_img" style="background-image: url('<?php echo __DOM__; ?>img/banner/fondo-1.jpg'); width: 100%; height: 100vh; background-repeat: no-repeat;background-size: cover;">
    <div class="container">
        <div class="row" style="padding-top: 300px;">
         <div class="col-xl-12 text-center">
             <div class="section_title mb-60">
                <h3 class="text-light" style="font-family: 'Lobster', cursive;">CONTACTO</h3>
                <p class="text-light" style="font-weight: bold;">En esta sección esta la información de contacto.</p>
             </div>
         </div>
        </div>
    </div>
</div>
<!-- breadcam_area_end -->

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
            <div class="container mb-0">
                <div class="row">
                    <div class="col-lg-8">
                        <iframe style="width: 100%; height: 100%"frameborder="0" style="border:0"src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDFeDM_42yi6YQhMJdNZHi-ZtF2ZC_bpLg&q=Nuevo+León+1008,+Lampacitos+III,+88789+Reynosa,+Tamps." allowfullscreen></iframe>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>Calle Lampacitos, Col. Nuevo León.</h3>
                                <p>#1008 S/N, CP. 88780 Fraccionamiento Reynosa</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>+52 8132425337 <br><a href="https://wa.me/+528132425337/?text=Hola%21%20vengo%20desde%20la%20aplicaci%C3%B3n%20web%20de%20Pishy%20Bakes." target="_blank" style="color: #ff1212;">Dé click aqui para redirigir a WhatsApp</a></h3>
                                <p>Sólo WhatsApp</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>ajb0ussines@gmail.com</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pt-5">
                    <h2 class="contact-title text-center"  style="font-family: 'Lobster', cursive;"">Formulario</h2>
                        <p><?php echo $alertaUsr; ?></p>
                        <form class="form-contact contact_form" method="post" action="<?php echo __DOM__;?>contactp/contactproccess"novalidate="novalidate">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Escribe tu nombre'" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Correo electronico'" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tema'" placeholder="Tema">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
    
                                        <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Escribe tu mensaje'" placeholder=" Mensaje"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <!-- ================ contact section end ================= -->