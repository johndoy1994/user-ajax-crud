<!DOCTYPE html>

<html>

<head>

	<title>User Management</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<link rel="stylesheet" href="/resources/demos/style.css">

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">

</head>

<body>


	<div class="container">


		<div class="row">

		    <div class="col-lg-12 margin-tb">					

		        <div class="pull-left">

		            <h2>User Management</h2>

		        </div>

		        <div class="pull-right">

				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-user">

					  Create User

				</button>

		        </div>

		    </div>

		</div>


		<table class="table table-bordered">

			<thead>

			    <tr>

				<th>First name</th>

				<th>Last name</th>

				<th>Email</th>

				<th>Birthdate</th>

				<th>Role</th>

				<th width="200px">Action</th>

			    </tr>

			</thead>

			<tbody>

			</tbody>

		</table>


		<ul id="pagination" class="pagination-sm"></ul>


	    <!-- Create Item Modal -->

		<div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Create User</h4>

		      </div>

		      <div class="modal-body">

		      		<form data-toggle="validator" action="{{ route('user-ajax.store') }}" method="POST">

		      			<div class="form-group" id="error">
		      			</div>

		      			<div class="form-group">

							<label class="control-label" for="first_name">First name:</label>

							<input type="text" name="first_name" class="form-control" data-error="Please enter first name." />

							<div class="help-block with-errors"></div>


						</div>

						<div class="form-group">

							<label class="control-label" for="last_name">Last name:</label>

							<input type="text" name="last_name" class="form-control" data-error="Please enter last name." />

							<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

							<label class="control-label" for="birth_date">Birth date:</label>

							<input type="text" id="birth_date" name="birth_date" class="form-control" data-error="Please select birth date." required />

							<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

							<label class="control-label" for="email">Email:</label>

							<input type="text" name="email" class="form-control" data-error="Please enter email." required />

							<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

							<label class="control-label" for="password">Password:</label>

							<input type="password" name="password" class="form-control" data-error="Please enter password." required />

							<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

							<label class="control-label" for="role">Role:</label>

							<select name="role" class="form-control" data-error="Please select role.">
								<option value="0">simple user</option>
								<option value="1">Manager user</option>
							</select>

							<div class="help-block with-errors"></div>

						</div>

						

						<div class="form-group">

							<button type="submit" class="btn crud-submit btn-success">Submit</button>

						</div>

		      		</form>

		      </div>

		    </div>

		  </div>

		</div>


		<!-- Edit Item Modal -->

		<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Edit User</h4>

		      </div>

		      <div class="modal-body">


		      		<form data-toggle="validator" action="" method="put">

		      			<div class="form-group">

							<label class="control-label" for="first_name">First name:</label>

							<input type="text" name="first_name" class="form-control" data-error="Please enter first name." required />

							<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

							<label class="control-label" for="last_name">Last name:</label>

							<input type="text" name="last_name" class="form-control" data-error="Please enter last name." required />

							<div class="help-block with-errors"></div>

						</div>




						<div class="form-group">

							<label class="control-label" for="birth_date">Birth date:</label>

							<input type="text" id="birth_date" name="birth_date" class="form-control" data-error="Please select birth date." required />

							<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

							<label class="control-label" for="email">Email:</label>

							<input type="text" name="email" class="form-control" data-error="Please enter email." required />

							<div class="help-block with-errors"></div>

						</div>

						
						<div class="form-group">

							<label class="control-label" for="role">Role:</label>

							<select name="role" id="role" class="form-control" data-error="Please select role.">
								<option value="0">simple user</option>
								<option value="1">Manager user</option>
							</select>

							<div class="help-block with-errors"></div>

						</div>

						<!-- <div class="form-group">

							<label class="control-label" for="title">Description:</label>

							<textarea name="description" class="form-control" data-error="Please enter description." required></textarea>

							<div class="help-block with-errors"></div>

						</div> -->

						<div class="form-group">

							<button type="submit" class="btn btn-success crud-submit-edit">Submit</button>

						</div>

		      		</form>


		      </div>

		    </div>

		  </div>

		</div>


	</div>

	<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>


  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>


	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>


	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


        <script type="text/javascript">

    	   var url = "<?php echo route('user-ajax.index')?>";

  
		  $( function() {
		    $( "#birth_date" ).datepicker();
		  } );
  

        </script>

        <script src= {{asset("public/js/user-ajax.js")}}></script> 


</body>

</html>