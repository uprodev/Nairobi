<?php
/*
Template Name: Choose
*/
?>

<?php get_header(); ?>

<section class="choose-block">
	<div class="content-width">
		<h1>Select you plans </h1>
		<div class="content">
			<form action="#" class="form-default">
				<div class="left">
					<p class="title">1. Choose your preferences</p>
					<p>Your preferences help us show you the most relevant recipes first. </p>
					<div class="input-wrap input-big-check">
						<p class="label">Choose options</p>
						<div class="wrap">
							<div class="item">
								<input type="radio" id="select-1-1" name="select-1">
								<label for="select-1-1" class="select-label">
									<span class="img-wrap">
										<img src="img/icon-2-1.svg" alt="">
									</span>
									<span class="text">Discovery box </span>
									<span class="check-img"><img src="img/icon-3.svg" alt=""></span>
								</label>
							</div>
							<div class="item">
								<input type="radio" id="select-1-2" name="select-1">
								<label for="select-1-2" class="select-label">
									<span class="img-wrap">
										<img src="img/icon-2-2.svg" alt="">
									</span>
									<span class="text">Mystery box </span>
									<span class="check-img"><img src="img/icon-3.svg" alt=""></span>
								</label>
							</div>
							<div class="item">
								<input type="radio" id="select-1-3" name="select-1">
								<label for="select-1-3" class="select-label">
									<span class="img-wrap">
										<img src="img/icon-2-3.svg" alt="">
									</span>
									<span class="text">Regular menu </span>
									<span class="check-img"><img src="img/icon-3.svg" alt=""></span>
								</label>
							</div>
						</div>
					</div>
					<div class="input-wrap input-wrap-number-col">
						<p class="title">2. Add details </p>
						<div class="number-item">
							<p>Adults </p>
							<div class="input-number ">
								<div class="btn-count btn-count-plus"><img src="img/icon-4-2.svg" alt=""></div>
								<input type="text" name="count" value="2" class="form-control"/>
								<div class="btn-count btn-count-minus"><img src="img/icon-4-1.svg" alt=""></div>
							</div>
						</div>
						<div class="number-item">
							<p>Kids</p>
							<div class="input-number ">
								<div class="btn-count btn-count-plus"><img src="img/icon-4-2.svg" alt=""></div>
								<input type="text" name="count" value="1" class="form-control"/>
								<div class="btn-count btn-count-minus"><img src="img/icon-4-1.svg" alt=""></div>
							</div>
						</div>
					</div>
					<div class="input-wrap input-wrap-characteristics tabs">
						<p class="title">3. Personal characteristics</p>
						<div class="wrap">
							<div class="select-block">
								<div class="nice-select tabs-menu">
									<span class="current">Person 1</span>
									<ul class="list">
										<li class="option selected"><a href="#">Person 1</a></li>
										<li class="option"><a href="#">Person 2</a></li>
										<li class="option"><a href="#">Person 3</a></li>
									</ul>
								</div>
							</div>

							<div class="check-new">
								<input type="checkbox" id="check-new" name="check-new" checked>
								<label for="check-new" class="label-new"></label>
								<span class="text">Apply to all</span>
							</div>
						</div>
						<div class="tab-content">
							<div class="tab-item">
								<div class="wrap-check">
									<div class="check-item">
										<input type="checkbox" id="check-2-1" name="check-2">
										<label for="check-2-1" class="round-check">
											<img src="img/icon-5-1.svg" alt="">
											<span class="text">Dairy </span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-2-2" name="check-2">
										<label for="check-2-2" class="round-check">
											<img src="img/icon-5-2.svg" alt="">
											<span class="text">Spicy</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-2-3" name="check-2">
										<label for="check-2-3" class="round-check">
											<img src="img/icon-5-3.svg" alt="">
											<span class="text">Vegie</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-2-4" name="check-2">
										<label for="check-2-4" class="round-check">
											<img src="img/icon-5-4.svg" alt="">
											<span class="text">Gluten</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-2-5" name="check-2">
										<label for="check-2-5" class="round-check">
											<img src="img/icon-5-5.svg" alt="">
											<span class="text">Soy-free</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-2-6" name="check-2">
										<label for="check-2-6" class="round-check">
											<img src="img/icon-5-6.svg" alt="">
											<span class="text">Egg-free</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-2-7" name="check-2">
										<label for="check-2-7" class="round-check">
											<img src="img/icon-5-7.svg" alt="">
											<span class="text">Nut-free</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-2-8" name="check-2">
										<label for="check-2-8" class="round-check">
											<img src="img/icon-5-8.svg" alt="">
											<span class="text">Shellfish-free</span>
										</label>
									</div>
								</div>
							</div>
							<div class="tab-item">
								<div class="wrap-check">
									<div class="check-item">
										<input type="checkbox" id="check-3-1" name="check-2-2">
										<label for="check-3-1" class="round-check">
											<img src="img/icon-5-1.svg" alt="">
											<span class="text">Dairy 2</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-3-2" name="check-2-2">
										<label for="check-3-2" class="round-check">
											<img src="img/icon-5-2.svg" alt="">
											<span class="text">Spicy</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-3-3" name="check-2-2">
										<label for="check-3-3" class="round-check">
											<img src="img/icon-5-3.svg" alt="">
											<span class="text">Vegie</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-3-4" name="check-2-2">
										<label for="check-3-4" class="round-check">
											<img src="img/icon-5-4.svg" alt="">
											<span class="text">Gluten</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-3-5" name="check-2-2">
										<label for="check-3-5" class="round-check">
											<img src="img/icon-5-5.svg" alt="">
											<span class="text">Soy-free</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-3-6" name="check-2-2">
										<label for="check-3-6" class="round-check">
											<img src="img/icon-5-6.svg" alt="">
											<span class="text">Egg-free</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-3-7" name="check-2-2">
										<label for="check-3-7" class="round-check">
											<img src="img/icon-5-7.svg" alt="">
											<span class="text">Nut-free</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-3-8" name="check-2-2">
										<label for="check-3-8" class="round-check">
											<img src="img/icon-5-8.svg" alt="">
											<span class="text">Shellfish-free</span>
										</label>
									</div>
								</div>
							</div>
							<div class="tab-item">
								<div class="wrap-check">
									<div class="check-item">
										<input type="checkbox" id="check-4-1" name="check-2-3">
										<label for="check-4-1" class="round-check">
											<img src="img/icon-5-1.svg" alt="">
											<span class="text">Dairy 3</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-4-2" name="check-2-3">
										<label for="check-4-2" class="round-check">
											<img src="img/icon-5-2.svg" alt="">
											<span class="text">Spicy</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-4-3" name="check-2-3">
										<label for="check-4-3" class="round-check">
											<img src="img/icon-5-3.svg" alt="">
											<span class="text">Vegie</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-4-4" name="check-2-3">
										<label for="check-4-4" class="round-check">
											<img src="img/icon-5-4.svg" alt="">
											<span class="text">Gluten</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-4-5" name="check-2-3">
										<label for="check-4-5" class="round-check">
											<img src="img/icon-5-5.svg" alt="">
											<span class="text">Soy-free</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-4-6" name="check-2-3">
										<label for="check-4-6" class="round-check">
											<img src="img/icon-5-6.svg" alt="">
											<span class="text">Egg-free</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-4-7" name="check-2-4">
										<label for="check-4-7" class="round-check">
											<img src="img/icon-5-7.svg" alt="">
											<span class="text">Nut-free</span>
										</label>
									</div>
									<div class="check-item">
										<input type="checkbox" id="check-4-8" name="check-2-5">
										<label for="check-4-8" class="round-check">
											<img src="img/icon-5-8.svg" alt="">
											<span class="text">Shellfish-free</span>
										</label>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="total-block">
					<div class="total-wrap">
						<p class="sub-title">Discovery box </p>
						<p class="info">3 meals for 4 people per week</p>
						<ul>
							<li>
								<p>Box price</p>
								<p><b>$71.88</b></p>
							</li>
							<li>
								<p>Price per serving</p>
								<p><b>$5.99</b></p>
							</li>
							<li class="last">
								<p>First box total</p>
								<p><b>$71.88</b></p>
							</li>
						</ul>
					</div>
					<div class="btn-wrap">
						<button type="submit" class="btn-default">Select </button>
					</div>
					<div class="check-total">
						<input type="checkbox" id="total" name="total">
						<label for="total" class="total-label">
							<span class="text">I want subscibe to mystery box every week</span>
						</label>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<?php get_footer(); ?>