<?
	use core\engine\BD;
	$pdo = BD::getInstanse();

	$tags2 = $pdo->getRows("SELECT tag_title_ru FROM cms_tags WHERE group_id = 2 ORDER BY id ASC");
	$tags4 = $pdo->getRows("SELECT tag_title_ru FROM cms_tags WHERE group_id = 4 ORDER BY id ASC");

/*	
	if ($vars[0]["action"] == "getTour") {
		echo '<h1>ТУР</h1>
			<input type="hidden" name="id" value="'.$_GET["id"].'" />
		';
		exit;
	}
*/


?>

<!-- Комментарии:
1. Фаил _blogpage.php вызывается из index.php вместо Route::getInstanse();. В рабочей версии это неверно, и данный фаил должен быть гле-то в \core\engine и называться Blog.php, не содержать header и footer а только рабочий функционал.
Но для тестого задания сделано проще.

2. Не нашёл стиль в \templates\site\css\styles.css который позволил бы добавлять теги справа, поэтому сделал с помощбю таблицы (table), строка 114.

3. Но зато нашёл стиль pagination и использовал для пагинации, строка 141.
-->

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
<title>Блог</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1.0, minimum-scale=1.0, maximum-scale=1.0" />

<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link href="./templates/site/css/owl.carousel.min.css" rel="stylesheet" />
<link href="./templates/site/css/jquery-ui.css" rel="stylesheet" />
<link href="./templates/site/css/jquery.formstyler.css" rel="stylesheet" />
<link href="./templates/site/css/jquery.formstyler.theme.css" rel="stylesheet" />
<link href="./templates/site/css/styles.css?1634211268" rel="stylesheet" />
<script src="./templates/site/js/jquery-3.1.1.min.js"></script>
<script src="./templates/site/js/jquery-ui.js"></script>
<script src="./templates/site/js/owl.carousel.min.js"></script>
<script src="./templates/site/js/jquery.formstyler.min.js"></script>
<script src="./templates/site/js/jquery.maskedinput.min.js"></script>
<script src="./templates/site/js/scripts.js?1634217123"></script></head>

<body>
	<header>
		<div>
			<a class="logo" href="/"><img src="./templates/site/img/logo.svg" alt="" /></a>
			<nav>
								<a href="./tours">Все туры</a>
								<a href="./countries">Туры по странам</a>
								<a href="./theme">Туры по тематикам</a>
								<a href="./discounts">Туры со скидкой</a>
						</nav>
			<div class="r">
				<div class="lang">
					<div class="sel">
						<img class="pl" src="./templates/site/img/ico_planeta.svg" alt="" />
						<div>Русский</div>
						<img class="ar" src="./templates/site/img/down-arrow.svg" alt="" />
					</div>
					<div class="options">
						<a class="" href="https://otetour.com">Английский</a>
						<a class="active" href="https://ru.otetour.com">Русский</a>
						<a class="" href="https://es.otetour.com">Испанский</a>
						<a class="" href="https://de.otetour.com">Немецкий</a>
						<a class="" href="https://it.otetour.com">Итальянский</a>
						<a class="" href="https://fr.otetour.com">Французский</a>
						<!--
						<a class="" href="https://fi.otetour.com">Финский</a>
						<a class="" href="https://el.otetour.com">Греческий</a>
						-->
					</div>
				</div>
				<div class="lc">
										<a class="am" href="./user/cabinet"><img src="./templates/site/img/ico_user.svg" alt="" /></a>
																	<div class="lcMenu">
								<div><a href="./user/cabinet">Личный кабинет</a></div>
								<div><a href="./user/cabinet/tours?t=1">Мои туры</a></div>
								<div><a href="./user/cabinet/reviews">Отзывы</a></div>
								<div><a href="./user/cabinet/orders">Заказы</a></div>
								<div><a href="./user/cabinet/messages">Сообщения</a></div>
								<div><a href="./user/cabinet/disputes">Споры</a></div>
								<div class="exit"><a href="./user/logout">Выйти</a></div>
							</div>
													</div>
			</div>
		</div>
	</header>
	<div class="htop"></div>
	
	
	
<!--
	<div class="topImgW">
		<img src="./templates/site/img/blog_item.jpg" alt="" />
	</div>
-->
	<div class="wrcont maintext inner mt0">
		<div class="breadcrumbs">
			<div><a href="/">Главная</a></div>
			<div><a href="./blog">Блог</a></div>
		</div>
		<h1>Блог</h1>
		<table>
		<tr>
		<td>
			<div class="img1">
				<img src="./templates/site/img/blog_item.jpg" alt="" />
			</div>
			<div class="dateCreated">26 октября 2021</div>
			<h1>Куда поехать в июле?</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vulputate eget nec odio facilisi facilisis diam ipsum malesuada diam. Tortor aliquet tincidunt consectetur ac sit nam risus vel. Pretium, nisi ac ultrices consectetur arcu egestas. Pellentesque quisque ut purus gravida diam mattis dui. Consectetur aenean sagittis sit eu ultrices. Quisque adipiscing ullamcorper adipiscing amet gravida. Eget gravida amet tempus tristique lectus pellentesque ipsum posuere. Sed adipiscing pretium, at dictumst maecenas ac a. Sagittis sed sit nibh praesent ipsum at odio pulvinar.</p>
			<div class="lineTags">
				<a href="#">Африка</a>
				<a href="#">Идеи путешествий</a>
				<a href="#">Ещё тег</a>
			</div>
			
			<div class="img1" style="padding-top: 30px">
				<img src="./templates/site/img/bl5.png" alt="" />
			</div>
			<div class="dateCreated">26 октября 2021</div>
			<h1>Парижские тайны</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vulputate eget nec odio facilisi facilisis diam ipsum malesuada diam. Tortor aliquet tincidunt consectetur ac sit nam risus vel. Pretium, nisi ac ultrices consectetur arcu egestas. Pellentesque quisque ut purus gravida diam mattis dui. Consectetur aenean sagittis sit eu ultrices. Quisque adipiscing ullamcorper adipiscing amet gravida. Eget gravida amet tempus tristique lectus pellentesque ipsum posuere. Sed adipiscing pretium, at dictumst maecenas ac a. Sagittis sed sit nibh praesent ipsum at odio pulvinar.</p>
			<div class="lineTags">
				<a href="#">Париж</a>
				<a href="#">Истории гидов</a>
				<a href="#">Франция</a>
			</div>
		
			<div class="pagination" style="justify-content: center">
				<a href="#" class="active">1</a>
				<a href="#">2</a>
				<a href="#">3</a>
			</div>
		</td>
		<td valign="top" width="400px" style="padding-left: 80px;">
			<h4>Популярные теги</h4>
			<div class="lineTags">
				<?php
					for ($i=0; $i<10; $i++) {
						echo "<a href=\"#\">".$tags2[$i]["tag_title_ru"]."</a>";
					}
				?>
				<a href="#">Европа</a>
				<a href="#">Своими глазами</a>
				<a href="#">Истории гидов</a>
			</div>
			<h4>Популярные направления</h4>
			<div class="lineTags">
				<?php
					for ($i=0; $i<10; $i++) {
						echo "<a href=\"#\">".$tags4[$i]["tag_title_ru"]."</a>";
					}
				?>
			</div>
		</td>
		</table>
		
		
	</div>
	
	
	
	
	
	
	
	
	
	<footer>
	<div>
		<div class="fmenu">
			<div>
				<h4>Для путешественников</h4>
									<div><a href="/">Главная</a></div>
							</div>
			<div>
				<h4>O.T.E.TOUR</h4>
									<div><a href="/">Главная</a></div>
							</div>
			<div>
				<h4>Гидам</h4>
									<div><a href="/">Главная</a></div>
							</div>
			<div>
				<h4>Партнёрам</h4>
									<div><a href="/">Главная</a></div>
							</div>
		</div>
		<div class="footer">
			<div class="cr">© 2021 OTE TOUR</div>
			<div class="z">
				<div class="t">Остались вопросы?</div>
				<div class="b">Связаться с нами</div>
			</div>
			<div class="social">
				<a href="#"><img src="./templates/site/img/soc1.svg" alt="" /></a>
				<a href="#"><img src="./templates/site/img/soc2.svg" alt="" /></a>
				<a href="#"><img src="./templates/site/img/soc3.svg" alt="" /></a>
			</div>
			<div class="paylogo">
				<img class="d" src="./templates/site/img/logopay2.png" alt="" />
				<img class="m" src="./templates/site/img/logopay1.png" alt="" />
			</div>
		</div>
	</div>
</footer></body>
</html>