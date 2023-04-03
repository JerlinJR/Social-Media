



<div class="album py-5 bg-light">
			<div class="container">

				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
					<?php
						use Carbon\Carbon;
					 	$posts = Post::getAllPost();
							foreach($posts as $post){
									$p = new Post($post['id']);
									$uploaded_time = Carbon::parse($p->getUploadedTime());
									$uploaded_time_str = $uploaded_time->diffForHumans();
							
						?>
					<div class="col">
						<div class="card shadow-sm">
							<!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
								xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
								preserveAspectRatio="xMidYMid slice" focusable="false">
								<title>Placeholder</title>
								<rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
									dy=".3em">Thumbnail</text>
							</svg> -->

							<img src="<?=$p->getImageUri()?>" height='225' width="100%">

							<div class="card-body">
								<p class="card-text"> <?=$p->getPostText() ?> </p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
										<button type="button" class="btn btn-sm btn-outline-primary">Like</button>
										<button type="button" class="btn btn-sm btn-outline-success">Share</button>
										<?php
										if(Session::isOwnerOf($p->getOwner())){
											?>
										<button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
										<?php
										}
										?>
									</div>
									<small class="text-muted"> <?=$uploaded_time_str ?> </small>
								</div>
							</div>
						</div>
						<?php
							}
						?>
					</div>
