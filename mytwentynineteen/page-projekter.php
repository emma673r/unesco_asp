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
			</nav>
      <section id="liste"></section>

		</main><!-- #main -->
			</div><!-- #primary -->


<script>

		const url = "http://emsportfolio.dk/kea/09_cms/unesco_asp/wp-json/wp/v2/projekt?per_page=100";
		const catUrl = "http://emsportfolio.dk/kea/09_cms/unesco_asp/wp-json/wp/v2/categories";
		let filter = "alle";
		let filterProjekt = "alle";
		let projekter = [];
		let categories = [];
		let parsedFilterProjekt;



window.addEventListener("DOMContentLoaded", start);

function start() {
  hentData();
}

async function hentData() {
  const respons = await fetch(url);
  const catData = await fetch(catUrl);
  projekter = await respons.json();
  categories = await catData.json();
  console.log(projekter);
  console.log(categories);
  visProjekter();
  opretKnapper();
}

function opretKnapper() {
categories.forEach (cat => {
document.querySelector("#filtrering").innerHTML += `<button class="filter" data-projekt="${cat.name}">${cat.name}</button>`
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
	
	visProjekter();
}

function visProjekter() {
	console.log("projekter", projekter);
	let temp = document.querySelector("template");
	let container = document.querySelector("#liste");
	
	 parsedFilterProjekt = parseInt(filterProjekt);
	
	console.log("filterProjekt",filterProjekt);
	console.log("parsedFilterProjekt",parsedFilterProjekt);
	container.innerHTML = "";
	
	projekter.forEach((projekt) => {
		console.log("projekt",projekt)
		console.log("projekt.categories",projekt.categories)
		if (filterProjekt == "alle" || projekt.categories.includes(filterProjekt)) {
			let klon = temp.cloneNode(true).content;

			klon.querySelector(".navn").innerHTML = projekt.navn;
			klon.querySelector(".kortbeskrivelse").innerHTML = projekt.kortbeskrivelse;
			klon.querySelector("img").src = projekt.billede;
			klon.querySelector("img").alt = projekt.slug;

			klon
				.querySelector("article")
				.addEventListener("click", () => location.href = projekt.link);
			
			container.appendChild(klon);
    	}
  	});
}


	  </script>



<?php
get_footer();
