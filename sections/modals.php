<!-- Log in -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">
					Log in
				</h4>
			</div>
			<div class="modal-body">
				<form id="form-login" action="" method="post">
					<input type="hidden" name="login">
					<input type="text" name="username" placeholder="Username" class="form-control" onkeyup="javascript:if(event.keyCode == 13){$('#form-login').submit();};" required><br>
					<input type="password" name="password" placeholder="Password" class="form-control" onkeyup="javascript:if(event.keyCode == 13){$('#form-login').submit();};" required><br>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" onclick="$('#form-login').submit();">Log in</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Sign in -->
<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">
					Sign in
				</h4>
			</div>
			<div class="modal-body">
				<form id="form-signin" action="" method="post">
					<input type="hidden" name="signin">
					<input type="text" name="username" placeholder="Username" class="form-control" onkeyup="javascript:if(event.keyCode == 13){$('#form-signin').submit();};" required><br>
					<input type="email" name="email" placeholder="E-mail" class="form-control" onkeyup="javascript:if(event.keyCode == 13){$('#form-signin').submit();};" required><br>
					<input type="password" name="password" id="password1" placeholder="Password" class="form-control" onkeyup="javascript:if(event.keyCode == 13){$('#form-signin').submit();};" required><br>
					<input type="password" name="password-confirm" id="password2" placeholder="Confirm password" class="form-control" onkeyup="javascript:if(event.keyCode == 13){$('#form-signin').submit();};" required>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-success" onclick="$('#form-signin').submit();">Sign in</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
