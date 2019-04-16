<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Vue.js Mysqli CRUD</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="js/axios.min.js"></script>
</head>
<body>
	
	<div id="root">
		<nav class="navbar navbar-expand-lg navbar-dark">
			<a class="navbar-brand" href="#"><img src="images/logo.png" alt="vue.js logo" class="logo-custom">ue.js</a>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<button class="btn btn-link" @click="showingaddModal = true;">Add User</button>
				</li>
			</ul>
		</nav>

		<div class="container p-5">
			<div class="row">

				<div class="alert alert-danger col-md-6" id="alertMessage" role="alert" v-if="errorMessage">
					{{ errorMessage }}
				</div>

				<div class="alert alert-success col-md-6" id="alertMessage" role="alert" v-if="successMessage">
					{{ successMessage }}
				</div>

				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th>S/N</th>
							<th>Username</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody class="tbody-custom">
						<tr v-for="user in users">
							<td>{{user.id}}</td>
							<td>{{user.username}}</td>
							<td>{{user.email}}</td>
							<td>{{user.mobile}}</td>
							<td><button @click="showingeditModal = true; selectUser(user);" class="btn btn-warning">Edit</button></td>
							<td><button @click="showingdeleteModal = true; selectUser(user);" class="btn btn-danger">Delete</button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	<!-- add modal -->
		<div class="modal col-md-6" id="addmodal" v-if="showingaddModal">
				<div class="modal-head">
					<p class="p-left p-2">Add user</p>
					<hr/>

					<div class="modal-body">
							<div class="col-md-12">
								<label for="uname">Username</label>
								<input type="text" id="uname" class="form-control" v-model="newUser.username">

								<label for="email">Email</label>
								<input type="text" id="email" class="form-control" v-model="newUser.email">

								<label for="phn">Mobile</label>
								<input type="text" id="phn" class="form-control" v-model="newUser.mobile">
							</div>

						<hr/>
							<button type="button" class="btn btn-success"  @click="showingaddModal = false; addUser();">Save changes</button>
							<button type="button" class="btn btn-danger"   @click="showingaddModal = false;">Close</button>
					</div>
				</div>
			</div>


	<!-- edit modal -->
		<div class="modal col-md-6" id="editmodal" v-if="showingeditModal">
			<div class="modal-head">
				<p class="p-left p-2">Edit user</p>
				<hr/>

				<div class="modal-body">
						<div class="col-md-12">
							<label for="uname">Username</label>
							<input type="text" id="uname" class="form-control" v-model="clickedUser.username">

							<label for="email">Email</label>
							<input type="text" id="email" class="form-control" v-model="clickedUser.email">

							<label for="phn">Mobile</label>
							<input type="text" id="phn" class="form-control" v-model="clickedUser.mobile">
						</div>

					<hr/>
						<button type="button" class="btn btn-success"  @click="showingeditModal = false; updateUser();">Save changes</button>
						<button type="button" class="btn btn-danger"   @click="showingeditModal = false;">Close</button>
				</div>
			</div>
		</div>


		<!-- delete data -->
		<div class="modal col-md-6" id="deletemodal" v-if="showingdeleteModal">
			<div class="modal-head">
				<p class="p-left p-2">Delete user</p>
				<hr/>

				<div class="modal-body">
						<center>
							<p>Are you sure you want to delete?</p>
							<h3>{{clickedUser.username}}</h3>
						</center>
					<hr/>
						<button type="button" class="btn btn-danger"  @click="showingdeleteModal = false; deleteUser();">Yes</button>
						<button type="button" class="btn btn-warning"   @click="showingdeleteModal = false;">No</button>
				</div>
			</div>
		</div>

	</div>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/vue.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>