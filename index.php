<?php 
	# on Submit it will create a new file with a name and a message of user
		$msg = '';
		$msgClass ='';
		

	if(filter_has_var(INPUT_POST, 'submit')){
		$name = $_POST['name'];
		$message = $_POST['message'];
		if(!empty($name) && !empty($message)){
				$current = file_get_contents('request.txt');
				$current .= "<i>".ucfirst($name)."</i> <small>sent:</small> ".$message."\n<br>";
				file_put_contents('request.txt', $current);
				$msg = 'Your message was sent';
				$msgClass ='alert-success';
				$message = '';
			}else{
			$msg = 'Both fields must be filled';
			$msgClass ='alert-danger';
		}
	}
	if(filter_has_var(INPUT_POST, 'clear')){
		file_put_contents('request.txt', '');
		$name = '';
		$message ='';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Post Request</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/cosmo/bootstrap.min.css">
	<style>
		#chatbox{
			width: 100%;
			height: 300px;
			border: 1px solid brown;
			padding: 20px 35px;
			overflow: scroll;
			line-height: 2rem;
		}
	</style>
</head>
<body onload="myFunction()">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h2 class="alert <?php echo $msgClass; ?>">It ll be green when you send and red when not</h2>
					<div id="chatbox"> <?php include 'request.txt'; ?></div>

					<form id="textbox" class="pt-5" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<div class="form-group">
							<label>Name:</label>
							<input type="text" name="name" placeholder="Enter name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
						</div>
						
						<div class="form-group">
							<label>Message:</label>
							<textarea type="text" name="message" placeholder="Enter message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea> 
						</div>
						<input type="submit" class="btn btn-success" name="submit" value="Submit">
						<button class="btn btn-danger" name="clear">Clear Chat</button>
					</form>	
			</div>
			<div class="col-md-4">
				
			</div>
		</div>
	</div>



	<script>
		function myFunction() {
  		   var element = document.getElementById('chatbox');
   element.scrollTop = element.scrollHeight - element.clientHeight;
}
	</script>
	<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
	<script>CKEDITOR.replace( 'message' );</script>
</body>
</html>