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
		const verdensmalUrl = "http://emsportfolio.dk/kea/09_cms/unesco_asp/wp-json/wp/v2/verdensmal";
		const uddanelseUrl = "http://emsportfolio.dk/kea/09_cms/unesco_asp/wp-json/wp/v2/uddanelsesniveau";
		let filter = "alle";
		let filterProjekt = "alle";
		let projekter = [];
		let verdensmal = [];
		let uddanelse = [];



window.addEventListener("DOMContentLoaded", start);

function start() {
  hentData();
}

async function hentData() {
  const respons = await fetch(url);
  const verdensmalData = await fetch(verdensmalUrl);
  const uddanelseData = await fetch(uddanelseUrl);
  projekter = await respons.json();
  verdensmal = await verdensmalData.json();
  uddanelse = await uddanelseData.json();
  console.log(projekter);
  console.log(verdensmal);
  visProjekter();
  opretKnapper();
}

function opretKnapper() {
verdensmal.forEach (verdensmal => {
document.querySelector("#filtrering").innerHTML += `<button class="filter" data-projekt="${verdensmal.name}">${verdensmal.name}</button>`
})
uddanelse.forEach (udd => {
document.querySelector("#filtrering").innerHTML += `<button class="filter" data-projekt="${udd.name}">${udd.name}</button>`
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
	container.innerHTML = "";
	
	projekter.forEach((projekt) => {
		console.log("projekt",projekt)
		console.log("projekt.verdensmal",projekt.verdensmal)
		console.log("projekt.uddanelse",projekt.uddanelse)
		if (filterProjekt == "alle" || projekt.verdensmal.includes(filterProjekt) || projekt.uddanelsesniveau.includes(filterProjekt)) {
			
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
