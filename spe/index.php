<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal</title>
    <!--<link rel="stylesheet" href="styles.css">-->
    <script type="module" src="slider.js"></script>
    <link rel="stylesheet" href="slider.css">


</head>
<body>

<header>
    <?php 
    //include_once('header/header.php');
    ?>
</header>

<main>
<div class="slider">
	<button class="slider--btn slider--btn__prev">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<path d="m15 18-6-6 6-6" />
		</svg>
	</button>

	<div class="slides__wrapper">
		<div class="slides">
			<!-- slide 1 -->
			<div class="slide" data-current>
				<div class="slide__inner">
					<div class="slide--image__wrapper">
                        <a href="monuments.php?ville=paris&lang=fr">
						<img class="slide--image" src="img/Paris.jpg" alt="Image 1" />
                        </a>
					</div>
				</div>
			</div>
			<div class="slide__bg" style="--bg: url(img/Paris.jpg); --dir: 0" data-current></div>

			<!-- slide 2 -->
			<div class="slide" data-next>
				<div class="slide__inner">
					<div class="slide--image__wrapper">
                    <a href="monuments.php?ville=marseille&lang=fr">
						<img class="slide--image" src="img/Marseille.jpg" alt="Image 1" />
                    </a>
					</div>
				</div>
			</div>
			<div class="slide__bg" style="--bg: url(img/Marseille.jpg); --dir: 1" data-next></div>

			<!-- slide 3 -->
			<div class="slide" data-previous>
				<div class="slide__inner">
					<div class="slide--image__wrapper">
                    <a href="monuments.php?ville=lyon&lang=fr">
						<img class="slide--image" src="img/Lyon.jpg" alt="Image 1" />
                    </a>
					</div>
				</div>
			</div>
			<div class="slide__bg" style="--bg: url(img/Lyon.jpg); --dir: -1" data-previous></div>
		</div>
		<div class="slides--infos">
			<!-- Slide Info 1 -->
			<div class="slide-info" data-current>
				<div class="slide-info__inner">
					<div class="slide-info--text__wrapper">
						<div data-title class="slide-info--text">
							<span>Paris</span>
						</div>
						<div data-subtitle class="slide-info--text">
							<span>France</span>
						</div>
						<div data-description class="slide-info--text">
							<span>Love city</span>
						</div>
					</div>
				</div>
			</div>

			<!-- Slide Info 2 -->
			<div class="slide-info" data-next>
				<div class="slide-info__inner">
					<div class="slide-info--text__wrapper">
						<div data-title class="slide-info--text">
							<span>Marseile</span>
						</div>
						<div data-subtitle class="slide-info--text">
							<span>France</span>
						</div>
						<div data-description class="slide-info--text">
							<span>Coast city</span>
						</div>
					</div>
				</div>
			</div>

			<!-- Slide Info 3 -->
			<div class="slide-info" data-previous>
				<div class="slide-info__inner">
					<div class="slide-info--text__wrapper">
						<div data-title class="slide-info--text">
							<span>Lyon</span>
						</div>
						<div data-subtitle class="slide-info--text">
							<span>France</span>
						</div>
						<div data-description class="slide-info--text">
							<span>Little Paris</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<button class="slider--btn slider--btn__next">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<path d="m9 18 6-6-6-6" />
		</svg>
	</button>
</div>

<div class="loader">
	<span class="loader__text">0%</span>
</div>
</main>

</body>
</html>
