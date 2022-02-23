<!DOCTYPE html>
<html>
<head>
	<title>Modal 2 sniplets</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>Bootstrap Example</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	

	
<body>
	<p> Open Request Modal </p>
	<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#req_modal_1">Open Request</button>
	<!-- Modal -->
	<div id="req_modal_1" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- modal contents-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Fill Details</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-sm-12">
							<form action="/action_page.php">
								<div class="form-group">
									<label for ="project_name">Project Name</label>
									<input type="text" class="form-control" readonly id="project_name">
									<label for ="plot_number">Plot#</label>
									<input type="text" class="form-control" readonly id="plot_number">
									<label for ="block" >Block</label>
									<input type="text" class="form-control"  readonly id="block">
									<label for ="request_to" >Request to</label>
										<select type="" class="form-control" id="request_to">
											<option>Hajiri</option>
											<option>Hazel</option>
											<option>Yolanda</option>
											<option>Misuka</option>
										</select>
									<label for ="priority" >Set Priority</label>
										<select type="" class="form-control" id="priority">
											<option>Normal</option>
											<option>Argent</option>
											<option>Critical Agent</option>
										</select>
									<button type="submit" class="btn btn-default">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</body>
</html>