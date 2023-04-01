
<?php

// if(isset($_POST['post_text']) and isset($_POST['post_image'])){
	

// } else {

// }

?>


<section class="py-5 text-center container">
			<div class="row py-lg-5">
				<form action="sg.php" method="post" enctype="multipart/form-data">
				<div class="col-lg-6 col-md-8 mx-auto">
					<h1 class="fw-light">What's Goin On?
						<?=Session::getUser()->getUsername()?>
					</h1>
					<p class="lead text-muted">Share Your Throughts Here</p>
					<textarea class="form-control" name="post_text" id="post_text" rows="3" placeholder="Whats on your mind ?" >
						</textarea>
						<div class="input-group mb-3">
							<input type="file" name="post_image" class="form-control" id="inputGroupFile02">
							<!-- <label class="input-group-text" for="inputGroupFile02">Upload</label> -->
						</div>
					<p>
						<button type="submit" class="btn btn-primary my-2">Upload 
						</button>
						<!-- <a href="#" class="btn btn-secondary my-2">Clear</a> -->
					</p>
				</div>
				</form>

			</div>
</section>