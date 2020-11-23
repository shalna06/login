<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Home</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body> 

<div class="container mt-2">
<div class="row">
<div class="col-md-8 mt-1 mb-1"><h2 class="text-white bg-dark">REGISTER</h2></div>
<!--<div class="col-md-8 mt-1 mb-2"><button type="button" id="addNewUser" class="btn btn-success">Add</button></div>-->
<div class="col-md-8">
<table class="table">
<thead>
<tr>   
<th scope="col">#</th>
<th scope="col">first Name</th> 
<th scope="col">Last Name</th>
<th scope="col">Email</th> 
<th scope="col">Password</th> 
<th scope="col">Image</th>
<th scope="col">Action</th> 
<th scope="col"></th>
</tr>
</thead>
<tbody>
<?php
include 'database.php'; 
$query="select * from registration limit 150"; 
$result=mysqli_query($conn,$query);
?>
<?php if ($result->num_rows > 0): ?>
<?php while($array=mysqli_fetch_row($result)): ?>
<tr>
<th scope="row"><?php echo $array[0];?></th>
<td><?php echo $array[1];?></td>
<td><?php echo $array[2];?></td>
<td><?php echo $array[3];?></td> 
<td><?php echo $array[4];?></td> 
<td><?php echo $array[5];?></td>
<td> 
<a href="javascript:void(0)"  class="btn btn-primary edit" data-id="<?php echo $array[0];?>">Edit</a></td>
<td><a href="javascript:void(0)" class="btn btn-primary delete" data-id="<?php echo $array[0];?>">Delete</a></td>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
<td colspan="3" rowspan="1" headers="">No Data Found</td>
</tr>
<?php endif; ?>
<?php mysqli_free_result($result); ?>
</tbody>
</table>
</div>
</div>        
</div>
<!-- boostrap model -->
<div class="modal fade" id="user-model" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="userModel"></h4>
</div>
<div class="modal-body">
<form action="javascript:void(0)" id="userInserUpdateForm" name="userInserUpdateForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" id="id">
<div class="form-group">
<label for="name" class="col-sm-2 control-label">First Name</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first Name" value="" maxlength="50" required="">
</div>
</div>  
<div class="form-group">
<label for="name" class="col-sm-2 control-label">Last Name</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last name" value="" maxlength="50" required="">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Email</label>
<div class="col-sm-12">
<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" required="">
</div>
</div> 
<div class="form-group">
<label class="col-sm-2 control-label">Password</label>
<div class="col-sm-12">
<input type="password" class="form-control" id="pass" name="password" placeholder="Enter Password" value="" required="">
</div>
</div> 
<div class="form-group">
<label class="col-sm-2 control-label">Image</label>
<div class="col-sm-12">
<input type="file" class="form-control" id="img" name="image" placeholder="Enter image" value="">
</div>
</div>
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-primary" id="btn-save" value="addNewUser">Save changes
</button>
</div>
</form>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
<!-- end bootstrap model -->
<script type="text/javascript">
$(document).ready(function($){
$('#addNewUser').click(function () {
$('#userInserUpdateForm').trigger("reset");
$('#userModel').html("Add New User");
$('#user-model').modal('show');
});
$('body').on('click', '.edit', function () { 

var id = $(this).data('id'); 
var edits = 'edit';
// ajax
$.ajax({
type:"POST",
url: "edit.php",
data: { id: id, edit:edits},
dataType: 'json', 
success: function(res){ 
alert(res);
$('#userModel').html("Edit User");
$('#user-model').modal('show'); 
$('#id').val(res.id); 

$('#fname').val(res[1]); 
$('#lname').val(res[2]);
$('#email').val(res[3]); 
$('#pass').val(res[4]);
}
});
});
$('body').on('click', '.delete', function () {
if (confirm("Delete Record?") == true) {
var id = $(this).data('id');
// ajax
$.ajax({
type:"POST",
url: "delete.php",
data: { id: id },
dataType: 'json',
success: function(res){
$('#name').html(res.name);
$('#age').html(res.age);
$('#email').html(res.email);
window.location.reload();
}
});
}
});
$('#userInserUpdateForm').submit(function() { 
alert($(this).serialize());
// ajax
$.ajax({
type:"POST",
url: "update.php",
data: $(this).serialize(), // get all form field value in 
dataType: 'json',
success: function(res){ 
window.location.reload();
}
});
});
});
</script>
</body>
</html>