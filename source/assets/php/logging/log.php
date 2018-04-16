<div class="dynamicContent">
	<div class="panel panel-default">
		<div class="panel-heading">
			Loxone Live Log Settings
		</div>
		<div class="panel-body">
			<p>@todo: enter description</p>
		</div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/script.inc.js"></script>
		<div class="live-log panel-body">
			<div style="height: 80px" class="col-lg-3">
				<p>choose a logfile:</p>
					<p>
						<select id="select-datei" multiple size=2 style="width:150px">
							<option value="log">Loxone.log</option>
							<option value="err">Loxone.err</option>
						</select>
					</p>
			</div>
			<div style="height: 80px" class="col-lg-3">
				<p>enter keyword to grep:</p>
					<input id="grep" type="text" />
				<p>"!" infront of the keyword negates the result</p>
			</div>
		</div>
		<div class="panel-heading">
			Loxone Live Log:
		</div>
		<div class="panel-body">
			<div id="testdiv">

			</div>
		</div>
	</div>
</div>