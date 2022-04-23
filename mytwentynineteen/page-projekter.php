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

	img {
		max-width:500px;
		height:auto;
	}
.dropdown {
  display: inline-block;
  position: relative;
}

#filt-verd, #filt-udd{
  display: none;
  position: absolute;
  width: 100%;
  overflow: scroll;
  box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.4);
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
  color: #000000;
  padding: 5px;
  text-decoration: none;
}

#filt-verd button:hover, #filt-udd button:hover {
  color: #ffffff;
  background-color: #00a4bd;
}

.filter button {
	width: 26ch;
}

</style>
			
      <template>
        <article id="projekter">
          <h3 class="navn"></h3>
          <img src="" alt=""/>
          <p class="kortbeskrivelse"></p>
          <p class="beskrivelse"></p>
          <p class="extra"></p>
		  <a href="">
        </article>
      </template>


	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<nav id="filtrering">
				<button data-projekt="alle">Alle</button>
				<div class="dropdown">FN verdensmål
					<div id="filt-verd"></div>
				</div>
				<div class="dropdown">Uddanelsesniveau
				<div id="filt-udd"></div></div>
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
	filterProjekt = this.dataset.projekt;
	console.log("this is this.dataset.projekt = " + this.dataset.projekt);
	
	visProjekter();
}

function visProjekter() {
	// console.log("projekter", projekter);
console.log(filterProjekt);


	let temp = document.querySelector("template");
	let container = document.querySelector("#liste");
	container.innerHTML = "";
	

	projekter.forEach((projekt) => {
		// console.log("projekt",projekt)
		console.log("projekt.verdensmal",projekt.verdensmal)
		console.log("projekt.uddanelsesniveau",projekt.uddanelsesniveau)

		// console.log(projekt.verdensmal.includes(filterProjekt));
		
		if (filterProjekt == "alle" || projekt.verdensmal.includes(filterProjekt) || projekt.uddanelsesniveau.includes(filterProjekt)) {
			
			let klon = temp.cloneNode(true).content;

			klon.querySelector(".navn").innerHTML = projekt.navn;
			klon.querySelector(".kortbeskrivelse").innerHTML = projekt.kortbeskrivelse;
			klon.querySelector("img").src = projekt.billede.guid;
			klon.querySelector("img").alt = projekt.slug;

			klon
				.querySelector("article")
				.addEventListener("click", () => location.href = projekt.link);
			
			container.appendChild(klon);
    	}
		
		else {
			console.log("Ingen projekter i denne kategori");
		}
  	});
}


	  </script>



<?php
get_footer();
