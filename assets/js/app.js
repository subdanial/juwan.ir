// AOS //
AOS.init({
	duration: 800,
});
document.addEventListener(
	"DOMContentLoaded", () => {
		new Mmenu( "#my-menu", {
			"navbar" :{
				"title":"<span class='text-white text-left'>فروشگاه لباس عمده ژوان</span>"
			},
		   "extensions": [
			  "pagedim-black",
			  "theme-dark"
		   ],
		   "iconbar": {
			  "use": true,
			  "top": [
				 "<a href='home.php'><i class='fas text-white fa-home'></i></a>",
			
			  ],
			  "bottom": [
				 "<a href='#/'><i class='fab text-white fa-telegram'></i></a>",
				 "<a href='#/'><i class='fab text-white fa-instagram-square'></i></a>",
				 "<a href='#/'><i class='fas text-white fa-phone-square'></i></a>"
			  ]
		   }
		});
	}
);
