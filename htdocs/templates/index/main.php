<div class="album py-5 bg-light">
	<div class="container">
	<h3 id="total-posts">Total Posts: N/A</h3>
	<!-- data-masonry='{"percentPosition": true }' -->
		<div class="row" id="masonry-area" >
			<?php
                $posts = Post::getAllPost();
				use Carbon\Carbon;
				foreach ($posts as $post) {
					$p = new Post($post['id']);
					// $owner = new User($post['owner']);
					$uploaded_time = Carbon::parse($p->getUploadedTime());
					$uploaded_time_str = $uploaded_time->diffForHumans();
            ?>
			<div class="col-lg-3 mb-4" id="post-<?=$post['id']?>">
				<div class="card">
					<img class="bd-placeholder-img card-img-top" src="<?=$p->getImageUri()?>">
					<div class="card-body">
						<p class="card-text"><?=$p->getPostText()?></p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="btn-group" data-id="<?=$post['id']?>">
								<button type="button" class="btn btn-sm btn-outline-primary btn-like">Like</button>
								<!-- <button type="button" class="btn btn-sm btn-outline-success">Share</button> -->
								<?php
								$user = Session::getUser();
								if (Session::isOwnerOf($p->getOwner())) {
								?>
								<button type="button" class="btn btn-sm btn-outline-danger btn-delete" >Delete</button>
								<?}?>
							</div>
							<!-- <small class="text-muted"> PostedBy:</small> -->
							<small class="text-muted"><?=$uploaded_time_str?></small>
							<!-- <button type="button" class="btn btn-sm btn-outline-secondary">PostedBy: </button> -->
						</div>
					</div>
				</div>
			</div>
			<?php
				}
				?>
		</div>
	</div>
</div>
