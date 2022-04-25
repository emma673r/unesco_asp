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

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <button class="tilbage" >Tilbage</button>

      <article>
        <h3 class="navn"></h3>
        <div class="grid1">
        <img class="img" src="" alt="">
        <p><span class="kortbeskrivelse"></span></p>
        <p><span class="beskrivelse"></span></p>
        <a href=""></a>
        <p><span class="extra"></span></p>
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
            document.querySelector(".beskrivelse").innerHTML = projekt.beskrivelse;
            document.querySelector(".img").src = projekt.billede.guid;
			      document.querySelector(".img").alt = projekt.slug;
        }
hentData();

        document.querySelector(".tilbage").addEventListener("click", ()=>{ history.back()});

    </script>



<?php
get_footer();
