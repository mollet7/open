<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Modal Example</title>
</head>
<body>
	<button onclick="document.getElementById('id01').style.display = 'block'">Open Modal</button>

	<div id="id01" class="modal">
		<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		<form class="modal-content" action="/action_page.php">
			<div class="container">
				<h1>Fill details</h1>
				<p>Sure delete!</p>

				<div class="clearfix">
					<button type="button" class="cancelbtn">Cancel</button>
					<button type="button" class="deletebtn">Delete</button>
				</div>
			</div>
		</form>
	</div>
<style>
* {box-sizing: border-box}

/* Set a style for all buttons */
button {
	background-color: #04AA6D;
	color: whitesmoke;
	padding: 14px 20px;
	margin: 8px 0;
	border: none;
	cursor: pointer;
	width: 100%;
	opacity: 0.9;

}
button:hover {
	opacity: 1;
}

/* Float cancel and delete buttons and add an equal width */
.cancelbtn, .deletebtn {
	float: left;
	width: 50%;
}

/* Add a color to the cancel button */
.cancelbtn {
	background-color: #ccc;
	color: black;
}

/* Add a color to the delete button */
.deletebtn {
	background-color: #f44336;
}

.container {
	padding: 16px;
	text-align: center;
}
.modal {
	display: none;
	position: fixed;
	z-index: 1;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	overflow: auto;
	background-color: #474e5d;
	padding-top: 50px;
}
/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* The Modal Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and delete button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .deletebtn {
    width: 100%;
  }
}
</style>
</body>
</html>