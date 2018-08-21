	window.onload = function () {
	var canvas = document.getElementById('canvas');
	var video = document.getElementById('video');
	var button = document.getElementById('take-a-photo');
	var allow = document.getElementById('allow');
	var context = canvas.getContext('2d');
	var videoStreamUrl = false;

	// функция которая будет выполнена при нажатии на кнопку захвата кадра
	var captureMe = function () {
		grayscale = document.getElementById("grayscale").value;
		brightness = document.getElementById("brightness").value;
		contrast = document.getElementById("contrast").value;
		sepia = document.getElementById("sepia").value;
		invert = document.getElementById("invert").value * 100;
		hue_rotate = document.getElementById("hue_rotate").value;
		opacity = (100 - document.getElementById("opacity").value) / 100;

		img = document.getElementById("video");
		img2 = document.getElementById("canvas");

		a_grayscale = document.getElementById("a_grayscale");
		a_grayscale.innerText = grayscale;



		a_brightness = document.getElementById("a_brightness");
		a_brightness.innerText = brightness - 100;

		a_contrast = document.getElementById("a_contrast");
		a_contrast.innerText = contrast - 100;

		a_sepia = document.getElementById("a_sepia");
		a_sepia.innerText = sepia;

		a_invert = document.getElementById("a_invert");
		a_invert.innerText = invert / 100;

		a_hue_rotate = document.getElementById("a_hue_rotate");
		a_hue_rotate.innerText = hue_rotate;

		a_opacity = document.getElementById("a_opacity");
		a_opacity.innerText = document.getElementById("opacity").value;

		

		

		img.style.filter = "\
							grayscale(" + grayscale + "%)\
							brightness(" + brightness + "%)\
							contrast(" + contrast + "%)\
							sepia(" + sepia + "%)\
							invert(" + invert + "%)\
							hue-rotate(" + hue_rotate + "deg)\
							opacity(" + opacity + ")\
							";
		img2.style.filter = img.style.filter;



		
		if (!videoStreamUrl) alert('То-ли вы не нажали "разрешить" в верху окна, то-ли что-то не так с вашим видео стримом')
		// переворачиваем canvas зеркально по горизонтали (см. описание внизу статьи)
		context.translate(canvas.width, 0);
		context.scale(-1, 1);
		// отрисовываем на канвасе текущий кадр видео
		context.drawImage(video, 0, 0, video.width, video.height);
		// получаем data: url изображения c canvas
		var base64dataUrl = canvas.toDataURL('image/png')/*.replace("image/png", "image/octet-stream")*/;
		context.setTransform(1, 0, 0, 1, 0, 0); // убираем все кастомные трансформации canvas

document.getElementById('hidden_data').value = base64dataUrl;
								var fd = new FormData(document.forms["form1"]);
 
								var xhr = new XMLHttpRequest();
								xhr.open('POST', 'save_video.php', true);
 
								xhr.upload.onprogress = function(e) {
										if (e.lengthComputable) {
												var percentComplete = (e.loaded / e.total) * 100;
												console.log(percentComplete + '% uploaded');
												 alert('Succesfully uploaded');
										}
								};
 
								xhr.onload = function() {
 
								};
								xhr.send(fd);


	}


	





	button.addEventListener('click', captureMe);

	// navigator.getUserMedia  и   window.URL.createObjectURL (смутные времена браузерных противоречий 2012)
	navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
	window.URL.createObjectURL = window.URL.createObjectURL || window.URL.webkitCreateObjectURL || window.URL.mozCreateObjectURL || window.URL.msCreateObjectURL;

	// запрашиваем разрешение на доступ к поточному видео камеры
	navigator.getUserMedia({video: true}, function (stream) {
		// разрешение от пользователя получено
		// скрываем подсказку
		allow.style.display = "none";
		// получаем url поточного видео
		videoStreamUrl = window.URL.createObjectURL(stream);
		// устанавливаем как источник для video 
		video.src = videoStreamUrl;
	}, function () {
		console.log('что-то не так с видеостримом или пользователь запретил его использовать :P');
	});
	};





	










