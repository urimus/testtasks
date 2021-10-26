<?
	use core\engine\BD;
	$pdo = BD::getInstanse();

	//WHERE status = 1
//	$tours = $pdo->getRows("SELECT id, page_id, lang, name, title, description, h1, content FROM cms_pages_blog ORDER BY id DESC");
//	echo "tours:".$tours[7]["id"];
	
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
		<table border = "1">
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
		
<!--
			<div class="img2">
				<img src="./templates/site/img/bl1.png" alt="" />
				<img src="./templates/site/img/bl2.png" alt="" />
			</div>
			<h2>Заголовок</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. A elementum diam augue tincidunt ultrices orci congue. Massa diam orci, mollis morbi semper aliquam. Tellus nunc nullam odio diam eget eu blandit. Sed cursus bibendum adipiscing facilisis nec. Neque ultricies condimentum ullamcorper velit diam. Ut neque aenean et pulvinar aliquam gravida. Eu, amet, tristique feugiat sed neque cursus dui dolor risus. Mattis aliquam orci augue suspendisse pellentesque erat sit. Condimentum nisl egestas sed habitasse aenean mattis eget massa consequat. Senectus velit tempor vel, vel pellentesque tortor, donec id posuere.</p>
			<h3>Небольшой заголовок</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. A elementum diam augue tincidunt ultrices orci congue. Massa diam orci, mollis morbi semper aliquam. Tellus nunc nullam odio diam eget eu blandit. Sed cursus bibendum adipiscing facilisis nec. Neque ultricies condimentum ullamcorper velit diam. Ut neque aenean et pulvinar aliquam gravida. Eu, amet, tristique feugiat sed neque cursus dui dolor risus. Mattis aliquam orci augue suspendisse pellentesque erat sit. Condimentum nisl egestas sed habitasse aenean mattis eget massa consequat. Senectus velit tempor vel, vel pellentesque tortor, donec id posuere.</p>
			<h3>Небольшой заголовок</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. A elementum diam augue tincidunt ultrices orci congue. Massa diam orci, mollis morbi semper aliquam. Tellus nunc nullam odio diam eget eu blandit. Sed cursus bibendum adipiscing facilisis nec. Neque ultricies condimentum ullamcorper velit diam. Ut neque aenean et pulvinar aliquam gravida. Eu, amet, tristique feugiat sed neque cursus dui dolor risus. Mattis aliquam orci augue suspendisse pellentesque erat sit.</p>
			<p>Condimentum nisl egestas sed habitasse aenean mattis eget massa consequat. Senectus velit tempor vel, vel pellentesque tortor, donec id posuere. Pretium cursus pretium quis auctor id elementum consectetur vitae tellus. Adipiscing diam malesuada lectus euismod ac, in sapien vestibulum et. Mattis quam diam nisl, enim commodo mi viverra. Odio placerat consequat eget ullamcorper accumsan odio proin fringilla euismod. Dignissim risus, nulla erat pulvinar vestibulum elit, nibh at. Molestie dolor dictum tortor amet, a facilisis cursus justo. Eget phasellus adipiscing nisl laoreet maecenas. Posuere pharetra massa nunc, aliquam metus cras. Est elementum auctor elit facilisi.</p>
			<div class="img2">
				<img src="./templates/site/img/bl3.png" alt="" />
				<img src="./templates/site/img/bl4.png" alt="" />
			</div>
			<h2>Заголовок</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. A elementum diam augue tincidunt ultrices orci congue. Massa diam orci, mollis morbi semper aliquam. Tellus nunc nullam odio diam eget eu blandit. Sed cursus bibendum adipiscing facilisis nec. Neque ultricies condimentum ullamcorper velit diam. Ut neque aenean et pulvinar aliquam gravida. Eu, amet, tristique feugiat sed neque cursus dui dolor risus. Mattis aliquam orci augue suspendisse pellentesque erat sit. Condimentum nisl egestas sed habitasse aenean mattis eget massa consequat. Senectus velit tempor vel, vel pellentesque tortor, donec id posuere.</p>
			<div class="img1">
				<img src="./templates/site/img/bl5.png" alt="" />
			</div>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. A elementum diam augue tincidunt ultrices orci congue. Massa diam orci, mollis morbi semper aliquam. Tellus nunc nullam odio diam eget eu blandit. Sed cursus bibendum adipiscing facilisis nec. Neque ultricies condimentum ullamcorper velit diam. Ut neque aenean et pulvinar aliquam gravida. Eu, amet, tristique feugiat sed neque cursus dui dolor risus. Mattis aliquam orci augue suspendisse pellentesque erat sit.</p>
			<div class="botContLine">
				<div class="lineTags">
					<a href="#">Европа</a>
					<a href="#">Своими глазами</a>
					<a href="#">Истории гидов</a>
				</div>
				<div class="socShare">
					<span>Поделиться</span>
					<script src="https://yastatic.net/share2/share.js"></script>
					<div class="ya-share2" data-curtain data-size="s" data-color-scheme="blackwhite" data-limit="3" data-services="facebook,telegram,linkedin,vkontakte,whatsapp,blogger"></div>
				</div>
			</div>
			<div class="comments">
				<h2>Комментарии</h2>
				<div class="upage">
					<form class="fAjax addComment">
						<label class="labtxt">
							<span class="t">Добавить комментарий...</span>
							<textarea rows="5" name="comment"></textarea>
						</label>
						<div class="isRight"><input type="submit" value="Добавить" /></div>
					</form>
				</div>
				<div class="onecomm">
					<div class="img"><img src="./templates/site/img/bpface.png" alt="" /></div>
					<div class="info">
						<div class="name">Иван Иванов</div>
						<div class="date">17 июня 2021</div>
						<p>Отличная статья. Спасибо! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing rhoncus felis et a volutpat hendrerit metus tincidunt arcu. Pretium congue nec potenti magna aenean vestibulum, bibendum lobortis arcu. Tempor dui vel dignissim at ut et purus. Imperdiet lacus euismod a ac.</p>
						<div class="addAnswer">Ответить</div>
					</div>
				</div>
				<div class="onecomm">
					<div class="img"><img src="./templates/site/img/bpface.png" alt="" /></div>
					<div class="info">
						<div class="name">Иван Иванов</div>
						<div class="date">17 июня 2021</div>
						<p>Отличная статья. Спасибо! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing rhoncus felis et a volutpat hendrerit metus tincidunt arcu. Pretium congue nec potenti magna aenean vestibulum, bibendum lobortis arcu. Tempor dui vel dignissim at ut et purus. Imperdiet lacus euismod a ac.</p>
						<div class="addAnswer">Ответить</div>
					</div>
				</div>
			</div>
			<div class="moreBlogPages">
				<h2>Похожие статьи</h2>
				<div class="items">
					<div class="item">
						<a class="mlink" href="#">
							<span class="img"><img src="./templates/site/img/bmore1.png" alt="" /></span>
							<span class="date">19 мая 2021</span>
							<span class="name">Куда поехать в июле?</span>
						</a>
						<p>Краткое описание. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Semper montes, vitae eu ullamcorper duis egestas sapien mi.</p>
						<div class="lineTags">
							<a href="#">Африка</a>
							<a href="#">Идеи путешествий</a>
						</div>
					</div>
					<div class="item">
						<a class="mlink" href="#">
							<span class="img"><img src="./templates/site/img/bmore2.png" alt="" /></span>
							<span class="date">19 мая 2021</span>
							<span class="name">Куда поехать в июле?</span>
						</a>
						<p>Краткое описание. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Semper montes, vitae eu ullamcorper duis egestas sapien mi.</p>
						<div class="lineTags">
							<a href="#">Африка</a>
							<a href="#">Идеи путешествий</a>
						</div>
					</div>
					<div class="item">
						<a class="mlink" href="#">
							<span class="img"><img src="./templates/site/img/bmore3.png" alt="" /></span>
							<span class="date">19 мая 2021</span>
							<span class="name">Куда поехать в июле?</span>
						</a>
						<p>Краткое описание. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Semper montes, vitae eu ullamcorper duis egestas sapien mi.</p>
						<div class="lineTags">
							<a href="#">Африка</a>
							<a href="#">Идеи путешествий</a>
						</div>
					</div>
					<div class="f"></div>
				</div>
			</div>
-->

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