// AOS //
AOS.init({
	duration: 800,
});
document.addEventListener(
	"DOMContentLoaded", () => {
		new Mmenu( "#my-menu", {

			"navbars": [
				{
				   "position": "bottom",
				   "content": [
					 `<p class="w-100 mx-auto text-center pt-4 px-3 text-white ">
					 آدرس  : 
					 خیابان فردوسي، خیابان منوچهري، پاساژ سينا، طبقه همكف، پلاک 
					 ١٢ <br>
					 تماس : 0901 444 4230 
					</p>
					 `
					 
				   ]
				}
			 ],

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
				 "<a href='https://t.me/juwancomplex'><i class='fab text-white fa-telegram'></i></a>",
				 "<a href='tel:09014444230'><i class='fas text-white fa-phone-square'></i></a>"
			  ]
		   }
		   
		});
	}
);
