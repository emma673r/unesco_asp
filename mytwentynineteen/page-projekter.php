<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

<style>
main {
	padding-left: 10px;
	padding-right: 10px;
}

	h3 {
	background-color: #1D75B4;
	color:white;
	border:none;
	padding:5px;
	border-radius:25px;
	}

	button, .button {
  background-color: #ce6305;
  color: white;
  border-radius:25px;}


  .button_drop, .filter {
	  background-color: #ce6305;
	  color:white;
  }  

  /* .button:hover, .filter:hover, .dropdown:hover, button:hover {
	  color:white;
	  background-color:#ce6305;
  } */


/* burger menu start */

#burger_closed {
  width: 50px;
  height: 50px;
  color:black;
    position:absolute;
  top:30px;


}

#burger_opened {
  width: 50px;
  height: 50px;
  display: none;
  color:black;
    position:absolute;
  top:30px;

}

#hamburger {
  position: fixed;

  top: 1rem;
  right: 1rem;
  z-index: 1001;
}

.burger_menu {
  position: absolute;
overflow:scroll;
  transform: translateY(-100%);
  transition: transform 0.2s;
  top: 15px;
  left: 0;
  right: 0;
  bottom: auto;
  z-index: 1000;
  background-color: #ce6305;
  padding-top: 1rem;
  padding-bottom: 1rem;
  padding-left: 1rem;
  padding-right: 2rem;
  line-height: 40px;
  /* display: flex;
  flex-direction: column; */
}

.button, .button_drop {
  background-color: #ce6305;
}

.showMenu {
  transform: translateY(0%);
}

/* burger menu end */



@media only screen
  and (min-device-width: 600px) {

	main {
		padding-left: 50px;
		padding-right: 50px;
	}

	img {
		max-width:500px;
		height:auto;
	}

	.dropdown {
		display: inline-block;
		position: relative;

		background-color: ;
	}

	#filt-verd, #filt-udd{
		display: none;
		position: absolute;

		width: 100%;
		z-index: 1000;
	}

	#filt-verd button, #filt-udd button{
		width: 25ch;
	}

	.dropdown:hover #filt-verd, .dropdown:hover #filt-udd {
		display: block;
		width: auto;
		height: auto;
	}

	#filt-verd button, #filt-udd button {
		display: block;
		color: black;
		padding: 5px;
		text-decoration: none;
	}

	#filt-verd button:hover, #filt-udd button:hover {
		color: #ce6305;
		background-color: #f2efeb;
	}

	.filter button {
		width: 26ch;
	}
	  .button_drop, .filter {
	  background-color: #f2efeb;
	  color: black ;
	  border-radius:none;
  }  

	#liste {
		display: grid;
		/* grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); */
		grid-template-columns: 1fr 1fr;
	margin-bottom: 20px;
	}

	img {
		max-width: 500px;
	}
	
	button:hover, .dropdown:hover {
		background-color:#f2efeb;
		color:black;
}

	#projekter {
		height: 750px;
		width:500px;
		justify-self: center;
		/* display: flex: */
		flex-direction: column;
		background-color: #f2efeb;
		padding:10px;
		font-size: 14pt;
		margin-top: 20px;
		margin-bottom: 20px;
		text-overflow: ellipsis;
		border-radius: 25px;
		border-style: solid;
		border-width:5px;
		border-color: #1D75B4;
	}

	#projekter img {
		max-height: 300px;
		max-width: 450px;
	}

	#hamburger {
    display: none;
  }

  .burger_menu {
    /* display: flex; */
    flex-direction: column;
    transform: translateY(0);
    transition: transform 0.2s;
    position: relative;
	overflow: scroll;
    top: 0;
    left: 0;
    right: 0;
    border-radius: 0%;
    background: none;
    gap: 3%;
    font-size: 1.5rem;
	overflow: visible;
  }

	.button, .button_drop{
    	line-height: normal;
    	gap: 30px;
  }

  }



</style>
			
      <template>
        <article id="projekter">
          <h3 class="navn"></h3>
          <img src="" alt=""/>
          <p class="kortbeskrivelse"></p>
          <p class="beskrivelse"></p>
          <p class="extra"></p>
		  <!-- <a href=""> -->
        </article>
      </template>


	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<nav id="filtrering">
				<div class="burger_menu">
					<button class="button dropdown" data-projekt="alle">Alle</button>
					<div class="dropdown button">FN verdensmål
						<div id="filt-verd" class="button_drop"></div>
					</div>
					<div class="dropdown button">Uddannelsesniveau
						<div id="filt-udd" class="button_drop"></div>
					</div>
				</div>
				<div id="hamburger">
					<div id="burger_closed">☰</div>
					<div id="burger_opened">✕</div>
       			 </div>
			</nav>
      <section id="liste"></section>

		</main><!-- #main -->
			</div><!-- #primary -->


<script>

		const url = "http://emsportfolio.dk/kea/09_cms/unesco_asp/wp-json/wp/v2/projekt?per_page=100";
		const verdensmalUrl = "http://emsportfolio.dk/kea/09_cms/unesco_asp/wp-json/wp/v2/verdensmal?per_page=100";
		const uddanelsesniveauUrl = "http://emsportfolio.dk/kea/09_cms/unesco_asp/wp-json/wp/v2/uddanelsesniveau?per_page=100";

		let filter = "alle";
		let filterProjekt = "alle";

		let projekter = [];
		let verdensmal = [];
		let uddanelsesniveauer = [];



window.addEventListener("DOMContentLoaded", start);

function start() {
  hentData();
}

async function hentData() {
	// fetch url
  const respons = await fetch(url);
  const verdensmalData = await fetch(verdensmalUrl);
  const uddanelsesniveauData = await fetch(uddanelsesniveauUrl);

	// json

  projekter = await respons.json();
  verdensmal = await verdensmalData.json();
  uddanelsesniveauer = await uddanelsesniveauData.json();


//   console.log(projekter);
//   console.log("verdensmal",verdensmal);
//   console.log("uddanelsesniveauer", uddanelsesniveauer)

  visProjekter();
  opretKnapper();
}

function opretKnapper() {
	// knapper til verdensmål
	verdensmal.forEach (verdensmal => {
	document.querySelector("#filt-verd").innerHTML += `<button class="filter" data-projekt="${verdensmal.id}">${verdensmal.name}</button>`
	})

	// knapper til uddanelsesniveauer
	uddanelsesniveauer.forEach (uddanelsesniveau => {
	document.querySelector("#filt-udd").innerHTML += `<button class="filter" data-projekt="${uddanelsesniveau.id}">${uddanelsesniveau.name}</button>`
	})

	addEventListenersToButtons ();
}

function addEventListenersToButtons () {
	document.querySelectorAll("#filtrering button").forEach(elm => {
		elm.addEventListener("click", filtrering)
	})
}

function filtrering() {
	console.log("filtrering");
	console.log("this is this.dataset.projekt = " + this.dataset.projekt);

	if (this.dataset.projekt != "alle") {

		filterProjekt = parseInt(this.dataset.projekt);
		// console.log("this is this.dataset.projekt = " + this.dataset.projekt);
	}

	else {
		filterProjekt = this.dataset.projekt;
	}

	visProjekter();
}

function visProjekter() {
	// console.log("projekter", projekter);
	// console.log("filterProjekt i visProjekter" + filterProjekt);


	let temp = document.querySelector("template");
	let container = document.querySelector("#liste");
	container.innerHTML = "";
	

	projekter.forEach((projekt) => {
		// console.log("projekt",projekt)
		// console.log("projekt.verdensmal",projekt.verdensmal)
		// console.log("projekt.uddanelsesniveau",projekt.uddanelsesniveau)

		// console.log(projekt.verdensmal.includes(filterProjekt));
		
		if (filterProjekt == "alle" || projekt.verdensmal.includes(filterProjekt) || projekt.uddanelsesniveau.includes(filterProjekt)) {
	

			let klon = temp.cloneNode(true).content;

			klon.querySelector(".navn").innerHTML = projekt.navn;
			klon.querySelector(".kortbeskrivelse").innerHTML = projekt.kortbeskrivelse;
			klon.querySelector("img").src = projekt.billede.guid;
			klon.querySelector("img").alt = projekt.slug;
			// klon.querySelector("a").href = projekt.filer.guid;

			klon
				.querySelector("article")
				.addEventListener("click", () => location.href = projekt.link);
			
			container.appendChild(klon);
    	}
		
		// else {
		// 	container.style.fontSize = "50px";
		// 	container.innerHTML = "Der findes ingen projekter i denne kategori";
		// }
		
  	});
}
// burger menu script

const menu = document.querySelector(".burger_menu");
const menuItems = document.querySelectorAll(".button .button_drop");
const menuSubItems = document.querySelectorAll(".button_drop");
const hamburger = document.querySelector("#hamburger");
const closeIcon = document.querySelector("#burger_opened");
const menuIcon = document.querySelector("#burger_closed");

function toggleMenu() {
  if (menu.classList.contains("showMenu")) {
    menu.classList.remove("showMenu");
    closeIcon.style.display = "none";
    menuIcon.style.display = "block";
  } else {
    menu.classList.add("showMenu");
    closeIcon.style.display = "block";
    menuIcon.style.display = "none";
  }
}

hamburger.addEventListener("click", toggleMenu);

menuItems.forEach(function (item) {
  item.addEventListener("click", toggleMenu);
});

menuSubItems.forEach(function (item) {
  item.addEventListener("click", toggleMenu);
});


	  </script>



<?php
get_footer();
