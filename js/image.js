
		function changeImage(imgName) {
			image = document.getElementById('imgFilter');
			image2 = document.getElementById('imgFilter2');
			if (image)
				image.src = imgName;
			if (image2)
				image2.src = imgName;
		}

		function NewStyle() {
			grayscale = document.getElementById("grayscale").value;
			brightness = document.getElementById("brightness").value;
			contrast = document.getElementById("contrast").value;
			sepia = document.getElementById("sepia").value;
			invert = document.getElementById("invert").value * 100;
			hue_rotate = document.getElementById("hue_rotate").value;
			opacity = (100 - document.getElementById("opacity").value) / 100;

			img = document.getElementById("video");
			img2 = document.getElementById("canvas");
			imgFilter = document.getElementById("imgFilter");
			imgFilter2 = document.getElementById("imgFilter2");

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

			
			var style = "\
									grayscale(" + grayscale + "%)\
									brightness(" + brightness + "%)\
									contrast(" + contrast + "%)\
									sepia(" + sepia + "%)\
									invert(" + invert + "%)\
									hue-rotate(" + hue_rotate + "deg)\
									opacity(" + opacity + ")\
									";
			if (img)
				img.style.filter = style;
			if (img2)
				img2.style.filter = style;
			if (imgFilter)
				imgFilter.style.filter = style;
			if (imgFilter2)
				imgFilter2.style.filter = style;
		}

		function DefaultStyle() {
			grayscale = document.getElementById("grayscale");
			brightness = document.getElementById("brightness");
			contrast = document.getElementById("contrast");
			sepia = document.getElementById("sepia");
			invert = document.getElementById("invert");
			hue_rotate = document.getElementById("hue_rotate");
			opacity = document.getElementById("opacity");

			grayscale.value = 0;
			brightness.value = 100;
			contrast.value = 100;
			sepia.value = 0;
			invert.value = 0;
			hue_rotate.value = 0;
			opacity.value = 0;

			NewStyle();
			
		}


		function DownloadWithFilter() {
			var link = document.createElement('a');
			link.href = 'images.jpg';
			link.download = 'Download.jpg';
			document.body.appendChild(link);
			link.click();
		}











function getImgName() {
	var params = window
    .location
    .search
    .replace('?','')
    .split('&')
    .reduce(
        function(p,e){
            var a = e.split('=');
            p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
            return p;
        },
        {}
    );
    return(params['img_name']);
//console.log( params['img_name']);
}

// var img = document.getElementById('imageid'); 
// //or however you get a handle to the IMG
// var width = img.clientWidth;
// var height = img.clientHeight;

function changeSRC() {
	var newSRC = "img/f1_"+getImgName();
	var img = document.getElementById("canvas");
	img.src = newSRC;
	document.getElementById("content").innerHTML.reload;


	var newSRC2 = "img/f_"+getImgName();
	var img2 = document.getElementById("canvas");
	img2.src = newSRC2;

	// document.getElementById("canvas").src="img/f_"+getImgName();
	// document.getElementById("canvas").innerHTML.reload;


}

function changeF(newF) {
		
		$(function(){
			$.ajax({
				type: "POST",
				url: "changeF.php",
				data:    "f="+newF
						+"&img="+getImgName()
						+"&grayscale="+document.getElementById("grayscale").value
						+"&brightness="+document.getElementById("brightness").value
						+"&contrast="+document.getElementById("contrast").value
						+"&sepia="+document.getElementById("sepia").value
						+"&invert="+document.getElementById("invert").value
						+"&hue_rotate="+document.getElementById("hue_rotate").value
						+"&opacity="+document.getElementById("opacity").value,
				success: function(html){
					//$("#content").html(html);
				
					//$('#canvas').attr('src', "img/f_"+getImgName());
					//changeSRC();
					 
					 window.location.reload(true);
					
					
				}
			});
		return false;

		});
	}
	


	function saveStyle(f) {
		
		var data = "img="+getImgName()
						+"&grayscale="+document.getElementById("grayscale").value
						+"&brightness="+document.getElementById("brightness").value
						+"&contrast="+document.getElementById("contrast").value
						+"&sepia="+document.getElementById("sepia").value
						+"&invert="+document.getElementById("invert").value
						+"&hue_rotate="+document.getElementById("hue_rotate").value
						+"&opacity="+document.getElementById("opacity").value;
		if (f == 0)
			data = "img="+getImgName();
			$(function(){
			$.ajax({
				type: "POST",
				url: "saveStyle.php",
				data:   data,
				success: function(html){
					//$("#content").html(html);
				
					//$('#canvas').attr('src', "img/f_"+getImgName());
					//changeSRC();
					window.location.reload(true);
					// alert("OK");
				}
			});
		return false;

		});
	}




