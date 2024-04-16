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
                        <a href="monuments.php?ville=paris">
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
                    <a href="monuments.php?ville=marseille">
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
                    <a href="monuments.php?ville=lyon">
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

<!--div class="support">
	<a href="https://twitter.com/DevLoop01" target="_blank">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
		</svg>
	</a>
	<a href="https://github.com/devloop01/voyage-slider" target="_blank">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4" />
			<path d="M9 18c-4.51 2-5-2-7-2" />
		</svg>
	</a>
</div-->
</main>

</body>
</html>
