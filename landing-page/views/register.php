<div class="container-fluid img-form">
	<div class="form-all row align-items-center">
        <div class="col-md-4">
            <div class="row">
                <div class="col-12">
                    <h1>Registro</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h3 class="text-light">Tu seguridad es importante, Pishy Bake's protege tu información y no la comparte con terceros.<br>Es importante tu registro para poder realizar órdenes y darles su respectivo seguimiento.</h3>
                </div>
            </div>
        </div>

        <div class="col-md-8 w3ls-login">
			<!-- form starts here -->
			<form id="register-form" method="post">
				<div class="agile-field-txt form-group row">
					<div class="col-6">
						<label><i class="fa fa-user" aria-hidden="true"></i> Nombres:</label>
						<input type="text" id='fName' class="form-control" required="">
					</div>
					<div class="col-6">
						<label><i class="fa fa-user" aria-hidden="true"></i> Apellidos:</label>
						<input type="text" id='lName' class="form-control" required="">
					</div>
				</div>
				<div class="agile-field-txt form-group">
					<label><i class="fa fa-phone-alt" aria-hidden="true"></i> Number:</label>
					<input type="number" id='number' class="form-control" required="">
				</div>
				<div class="agile-field-txt form-group">
					<label><i class="fa fa-envelope" aria-hidden="true"></i> Correo electronico:</label>
					<input type="email" id='email' class="form-control" required="">
				</div>
				<div class="agile-field-txt form-group">
					<div class="agile-field-txt form-group row">
						<div class="col-6">
							<label><i class="fa fa-lock" aria-hidden="true"></i> Contraseña:</label>
							<input type="password" id='pwd1' class="form-control" required="">
						</div>
						<div class="col-6">
							<label><i class="fa fa-lock" aria-hidden="true"></i> Confirmar Contraseña:</label>
							<input type="password" id='pwd2' class="form-control" required="">
						</div>
					</div>
					<div class="agile_label">
						<input id="check3" name="check3" type="checkbox" value="show password" onclick="showPwd2()">
						<label class="check" for="check3">Mostrar Contraseña</label>
					</div>
				</div>
				<div class="w3ls-login w3l-sub form-group">
                    <input type="hidden" id='csrf_t' value="skjbdwtvedy3f6e83g:_">
					<input type="submit" value="Registrarse">
					<p class="text-center text-dark">¿Ya tienes una cuenta?<a href="<?php echo __DOM__; ?>page/iniciar_sesion" style="color: rgb(224, 14, 14);"> Accede aquí.</a></p>
				</div>
			</form>
		</div>
	</div>
</div>