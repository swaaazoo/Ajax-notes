<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ajax Notes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">

	
	$(document).on('submit', '#add', function(){
		$.post(
			$(this).attr('action'),
			$(this).serialize(),
			function(output){
				$('.notearea').append(
					'<div class="col-xs-3 fulldelete">'+
						'<div class="col-xs-10">'+
							'<form class="form-horizontal update" action="/notes/updateNote" method="POST">'+
								'<label>'+output.title+'</label>'+
								'<textarea name="description" placeholder="Enter note here" class="desc" cols="20" rows="4"></textarea>'+
								'<input type="hidden" name="id" value='+output.id+'>'+
							'</form>'+
								'<form class="form-horizontal mydelete" action="/notes/removeNote/" method="POST">'+
								'<input type="submit" class="btn btn-link" value="Delete">'+
								'<input type="hidden" name="id" value='+output.id+'>'+
							'</form>'+
						'</div>'+
					'</div>'
				);
			},
			"json"
		);
		$('#empty_input').val("");
		return false;
	});
	

	$(document).on('submit', 'form.mydelete', function(){
		var that = this;
		console.log(this);
		$.post(
			$(this).attr('action'),
			$(this).serialize(),
			function(output){
				$(that).closest('.fulldelete').remove();
			}
		);
		return false;
	});

	$(document).on('change', '.desc', function(){
		$.post(
			$(this).parent().attr('action'),
			$(this).parent().serialize()
		);
		return false;
	})

	</script>

	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<style type="text/css">
		* {
			margin: 0 auto;
			padding: 0;
			/*border: 0;*/
		}
		.container {
			width: 900;
			min-height: 300;
			margin: 40px;
		}
		.col-xs-10 {
			padding: 0;
		}
		label {
			width: 215px;
			height: 50px;
			vertical-align: bottom;
		}
	</style>
</head>

<body>
<div class="container">
	<div class="row notearea">
<?php
	if(isset($allNotes)){
		foreach($allNotes AS $note){ 
?>
			<div class="col-xs-3 fulldelete">  <!-- a note -->
				<div class="col-xs-10"> <!--  title/desc -->
					<form class="form-horizontal update" action="/notes/updateNote" method="POST">
						<label><?=  $note['title'] ?></label>
						<textarea name="description" placeholder="Enter note here" class="desc" cols="28" rows="4"><?=  $note['description'] ?></textarea>
						<input type="hidden" name="id" value="<?=$note['id']?>">
					</form> 
					<form class="form-horizontal mydelete" action="/notes/removeNote/" method="POST">
						<input type="submit" class="btn btn-link" value="Delete">
						<input type="hidden" name="id" value="<?=$note['id']?>">
					</form>
				</div>  <!--  END title/desc -->
			</div> <!-- END a note -->
<?php }
	}
?>
	</div>

	<div class="row create">
		<div class="col-xs-3">
			<h4>Notes:</h4>
			<form class="form-horizontal" id="add" action="/notes/addNote" method="POST">
				<div class="form-group">
					<input type="text" class="form-control" id="empty_input" name="title" placeholder="Insert note title here...">
				</div>
				<div class="form-group">
					<input type="submit" class="form-control btn btn-default" value="Add Note">
				</div>
			</form>
		</div>
	</div>
</div>
</body>

</html>