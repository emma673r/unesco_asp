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
        <img class="img" src="" alt="">
        <p><span class="langbeskrivelse"></span></p>
        <p>Pris: <span class="pris"></span></p>
      </article>
    	</main>
		</div><!-- #primary -->

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const id = <?php echo get_the_ID() ?>;
        console.log({id});
        let ret;

         const url = `http://emsportfolio.dk/kea/09_cms/babushka/wp-json/wp/v2/ret/${id}`;

              async function hentData() {
                  console.log("hentData");
            const respons = await fetch(url);
            ret = await respons.json();
            console.log({ret});
        vis();
        }

        function vis(){
            
            document.querySelector(".navn").textContent = ret.titel;
            document.querySelector(".langbeskrivelse").textContent = ret.beskrivelse;
			document.querySelector(".pris").textContent = `${ret.pris} dkk`;
            document.querySelector(".img").src = ret.billede.guid;
			document.querySelector(".img").alt = ret.titel;
        }
hentData();

        document.querySelector(".tilbage").addEventListener("click", ()=>{ history.back()});

    </script>



<?php
get_footer();
