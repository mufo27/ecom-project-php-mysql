    <!--====== FOOTER PART START ======-->
    <footer class="footer-area">

		<div class="copy-right">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="text-center">
							<p>Designed & Developed By <a href="#" rel="nofollow" target="_blank">GrayGrids</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--====== FOOTER PART ENDS ======-->

	<!--====== BACK TOP TOP PART START ======-->
	<a href="#" class="back-to-top btn-hover"><i class="lni lni-chevron-up"></i></a>
	<!--====== BACK TOP TOP PART ENDS ======-->


	<!--====== Bootstrap js ======-->
	<script src="assets/js/bootstrap.bundle-5.0.0.alpha-min.js"></script>

	<!--====== Tiny slider js ======-->
	<script src="assets/js/tiny-slider.js"></script>

	<!--====== wow js ======-->
	<script src="assets/js/wow.min.js"></script>

	<!--====== glightbox js ======-->
	<script src="assets/js/glightbox.min.js"></script>
	
	<!--====== Selectr js ======-->
	<script src="assets/js/selectr.min.js"></script>

	<!--====== Nouislider js ======-->
	<script src="assets/js/nouislider.js"></script>

	<!--====== Main js ======-->
	<script src="assets/js/main.js"></script>

	<script>

		//========= glightbox
		const myGallery = GLightbox({
			'href': 'assets/video/Free App Landing Page Template - AppLand.mp4',
			'type': 'video',
			'source': 'youtube', //vimeo, youtube or local
			'width': 900,
			'autoplayVideos': true,
		});

		//======== tiny slider for feature-product-carousel
		tns({
			slideBy: 'page',
			autoplay: false,
			mouseDrag: true,
			gutter: 20,
			nav: false,
			controls: true,
			controlsPosition: 'bottom',
			controlsText: [
				'<span class="prev"><i class="lni lni-chevron-left"></i></span>', 
				'<span class="next"><i class="lni lni-chevron-right"></i></span>'
			],
			container: ".feature-product-carousel",
			items: 1,
			center: false,
			autoplayTimeout: 5000,
			swipeAngle: false,
			speed: 400,
			responsive: {
				768: {
					items: 2,
				},

				992: {
					items: 2,
				},

				1200: {
					items: 3,
				}
			}
		});

		//======== tiny slider for testimonial
		tns({
			slideBy: 'page',
			autoplay: false,
			mouseDrag: true,
			gutter: 20,
			nav: true,
			controls: false,
			container: ".testimonial-carousel",
			items: 1,
			center: false,
			autoplayTimeout: 5000,
			swipeAngle: false,
			speed: 400,
			responsive: {
				768: {
					items: 2,
				},
				1200: {
					items: 3,
				}
			}
		});
	</script>

	<script>
		//======== select js
		new Selectr('#sort', {
			searchable: false,
			width: 300
		});

		var snapSlider = document.getElementById('slider-snap');

			noUiSlider.create(snapSlider, {
				start: [199, 789],
				// snap: true,
				connect: true,
				range: {
					'min': 99,
					'max': 999
				}
			});

			var snapValues = [
					document.getElementById('slider-snap-value-lower'),
					document.getElementById('slider-snap-value-upper')
				];

				snapSlider.noUiSlider.on('update', function (values, handle) {
					snapValues[handle].innerHTML = values[handle]
				});
	</script>