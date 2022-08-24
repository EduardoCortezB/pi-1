<div class="container-fluid img-form">
	<div class="form-all row align-items-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-12">
                    <h1>Inicio de sesión</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h3 class="text-light">Tu seguridad es importante, Pishy Bake's protege tu información y no la comparte con terceros.</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6 w3ls-login">
			<!-- form starts here -->
			<form id="login" method="post">
				<div class="agile-field-txt">
					<label>
					<i class="fa fa-envelope" aria-hidden="true"></i> Correo electronico:</label>
					<input type="email" id='eml' required="">
				</div>
				<div class="agile-field-txt">
					<label><i class="fa fa-lock" aria-hidden="true"></i> Contraseña:</label>
					<!-- <a href="#" class="w3ls-right">forgot password?</a> -->
					<input type="password" id='pwd' required="" id="myInput">
					<div class="agile_label">
						<input id="check3" name="check3" type="checkbox" value="show password" onclick="showPwd1()">
						<label class="check" for="check3">Mostrar Contraseña</label>
					</div>
				</div>
				<div class="w3ls-login  w3l-sub">
                    <input type="hidden" id='csrf_t' value="skjbdwtvedy3f6e83g:_">
					<input type="submit" value="Acceder">
                    <p class="text-center text-dark">¿Aún no estas registrado?<a href="<?php echo __DOM__; ?>page/registro" style="color: rgb(224, 14, 14);"> Registrate aquí.</a></p>
				</div>
			</form>
		</div>
	</div>
</div>