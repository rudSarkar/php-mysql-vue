var app = new Vue({

  el: "#root",
  data: {
  	showingaddModal: false,
  	showingeditModal: false,
  	showingdeleteModal: false,
  	errorMessage: "",
  	successMessage: "",
  	users: [],
  	newUser: {username: "", email: "", mobile: ""},
  	clickedUser: {},
  },

  mounted: function () {
  	console.log("Vue.js is running...");
  	this.getAllUsers();
  },

  methods: {
  	getAllUsers: function () {
  		axios.get('http://localhost/php-vue/api/v1.php?action=read')
  		.then(function (response) {
  			console.log(response);

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.users = response.data.users;
  			}
  		})
  	},

  	addUser: function () {
  		var formData = app.toFormData(app.newUser);
  		axios.post('http://localhost/php-vue/api/v1.php?action=create', formData)
  		.then(function (response) {
  			console.log(response);
  			app.newUser = {username: "", email: "", mobile: ""};

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.successMessage = response.data.message;
  				app.getAllUsers();
  			}
  		});
  	},

  	updateUser: function () {
  		var formData = app.toFormData(app.clickedUser);
  		axios.post('http://localhost/php-vue/api/v1.php?action=update', formData)
  		.then(function (response) {
  			console.log(response);
  			app.clickedUser = {};

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.successMessage = response.data.message;
  				app.getAllUsers();
  			}
  		});
  	},

  	deleteUser: function () {
  		var formData = app.toFormData(app.clickedUser);
  		axios.post('http://localhost/php-vue/api/v1.php?action=delete', formData)
  		.then(function (response) {
  			console.log(response);
  			app.clickedUser = {};

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.successMessage = response.data.message;
  				app.getAllUsers();
  			}
  		})
  	},

  	selectUser(user) {
  		app.clickedUser = user;
  	},

  	toFormData: function (obj) {
  		var form_data = new FormData();
  		for (var key in obj) {
  			form_data.append(key, obj[key]);
  		}
  		return form_data;
  	},

  	clearMessage: function (argument) {
  		app.errorMessage   = "";
  		app.successMessage = "";
  	},


  }
});