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


.grid1 {
  grid-row: 2;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-template-rows: repeat(auto-fit, minmax(300px, 1fr));
}

.img {
  max-width: 400px;
}

.img {
  grid-row:3;
}

.beskrivelse_div {
  display: grid;
  grid-template-columns: 1fr 3fr;
}

.kortbeskrivelse{
grid-column: 2;
}

.beskrivelse {
grid-column:1;
}

.extra {
  grid-row: 5;
}


</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <button class="tilbage" >Tilbage</button>

      <article>
        <h3 class="navn"></h3>
        <div class="grid1">
        <img class="img" src="" alt="">
        <div class="beskrivelse_div">
        <span class="kortbeskrivelse"></span>
         <span class="beskrivelse"></span>
        </div>
        <!-- <a href=""></a> -->
        <span class="extra"></span>
         </div>

      

      </article>
    	</main>
		</div><!-- #primary -->

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const id = <?php echo get_the_ID() ?>;
        console.log({id});
        let projekt;

        const url = `http://emsportfolio.dk/kea/09_cms/unesco_asp/wp-json/wp/v2/projekt/${id}`;

        async function hentData() {
        console.log("hentData");
        const respons = await fetch(url);
        projekt = await respons.json();
        console.log({projekt});
        vis();
        }

        function vis(){
            
          document.querySelector(".navn").textContent = projekt.navn;
          document.querySelector(".kortbeskrivelse").innerHTML = projekt.kortbeskrivelse;
          document.querySelector(".beskrivelse").innerHTML = projekt.content.rendered;
          document.querySelector(".img").src = projekt.billede.guid;
          document.querySelector(".img").alt = projekt.slug;
          document.querySelector(".extra").innerHTML = projekt.extra;
        }

        hentData();

        document.querySelector(".tilbage").addEventListener("click", ()=>{ history.back()});

    </script>



<?php
get_footer();
