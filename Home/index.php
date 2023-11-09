<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <div id="menu">
        <template id="menu_superior">
            <header class="caja_menu">
                <img class="logo" src="logo.svg" alt="">
                <a href="#"><button class="boton_menu">Home</button></a>
                <a href="../About_us/index.html"><button class="boton_menu">About us</button></a>
                <button class="boton_menu">Blogs</button>
                <button class="boton_menu">Contact</button>
                <a href="../Login/index.html"><img src="icon-user.svg" alt=""></a>
                <div class="search">
                    <input class="label" placeholder="Search">
                    <img src="search-outline.svg" alt="">
                </div>
            </header>
        </template>
    </div>

    <div id="page_content">
        <template id="foto_principal">
            <header class="headerImagen">
                <div class="cajaImagen">
                    <p class= "tituloImagen">Embark on your own adventure and let the world inspire you</p>
                    <p class= "textoImagen">City Blogs Around the Globe</p>
                </div>
            </header>
        </template>
        <template id="ultims_blogs">
            <section class="sectionLast">
                <div class="containerLast">
                    <img class="img" src="" alt="">
                    <h1 class="lastBlog">LASTEST BLOG</h1>
                    <h2 class="tituloLast">Paris: The City of Lights and Love</h2>
                    <p class="textoLast">Exploring the Magic and Romance of the French Capital</p>
                </div>
                <div class="containerRecent">
                    <h1 class="recentBlogs">Recent Blogs</h1>
                    <div class="cajaRecent">
                        <img class="imagen" src="" alt="">
                        <div class="tituloBotonRecent">
                            <h2 class="tituloRecent">Sydney: Where Urban Elegance Meets Natural Beauty</h2>
                            <button class="botonRecent">Read more</button>
                        </div>
                    </div>
                    <div class="cajaRecent">
                        <img class="imagen" src="" alt="">
                        <div class="tituloBotonRecent">
                            <h2 class="tituloRecent">Egypt: Where History and Mystique Unite</h2>
                            <button class="botonRecent">Read more</button>
                        </div>
                    </div>
                    <div class="cajaRecent">
                        <img class="imagen" src="" alt="">
                        <div class="tituloBotonRecent">
                            <h2 class="tituloRecent">Barcelona: A journey through Catalan Culture and rich History</h2>
                            <button class="botonRecent">Read more</button>
                        </div>
                    </div>
                </div>
                
            </section>
        </template>
        <template id="blogs_visitados">
            <section class="sectionBlogs">
                <h2 class="tituloBlogs">MOST VISITED BLOGS</h2>
                <div class="linea"></div>
                <h3 class="tituloContinente">EUROPE</h3>
                <section class="containerBlogs">
                    <div class="cajaBlog">
                        <img class="imagen" src="" alt="">
                        <p class="fechaBlog">August 20, 2022</p>
                        <h4 class="tituloBlog">Barcelona</h4>
                        <p class="textoBlog">Barcelona, in northeastern Spain, is famous for its iconic architecture, including Antoni Gaudí's Sagrada Familia and Park Güell. The city blends history, modernity, and a rich culinary culture.</p>
                        <a class="cajaBoton" href="../Article/index.php?id=<?php echo 1; ?>">
                            <p class="textoBoton">Read Full</p>
                            <img src="icon-arrow-right.svg" alt="">                            
                        </a>
                    </div>
                    <div class="cajaBlog">
                        <img class="imagen" src="" alt="">
                        <p class="fechaBlog">July 12, 2022</p>
                        <h4 class="tituloBlog">Berlin</h4>
                        <p class="textoBlog">Berlin, Germany's capital, boasts a rich history, cultural vibrancy, and iconic landmarks, including the Berlin Wall and Brandenburg Gate. It's a must-visit for its unique blend of past and present.</p>
                        <a class="cajaBoton" href="../Article/index.php?id=<?php echo 7; ?>">
                            <p class="textoBoton">Read Full</p>
                            <img src="icon-arrow-right.svg" alt="">                            
                        </a>
                    </div>
                    <div class="cajaBlog">
                        <img class="imagen" src="" alt="">
                        <p class="fechaBlog">January 9, 2023</p>
                        <h4 class="tituloBlog">Paris</h4>
                        <p class="textoBlog">Paris, France's capital, is renowned for its rich history, iconic landmarks like the Eiffel Tower and Louvre Museum, and its romantic ambiance. It's a top global destination, blending culture and charm.</p>
                        <div class="cajaBoton">
                            <p class="textoBoton">Read Full</p>
                            <img src="icon-arrow-right.svg" alt="">                            
                        </div>
                    </div>
                </section>
                <button class="botonMore">SEE MORE</button>
                <div class="linea"></div>
                <h3 class="tituloContinente">AMERICA</h3>
                <section class="containerBlogs">
                    <div class="cajaBlog">
                        <img class="imagen" src="" alt="">
                        <p class="fechaBlog">October 24, 2022</p>
                        <h4 class="tituloBlog">Los Angeles</h4>
                        <p class="textoBlog">Los Angeles, in the United States, is famous for its entertainment industry, stunning beaches, and diverse culture. It's a global city with a unique blend of glamour and natural beauty.</p>
                        <div class="cajaBoton">
                            <p class="textoBoton">Read Full</p>
                            <img src="icon-arrow-right.svg" alt="">                            
                        </div>
                    </div>
                    <div class="cajaBlog">
                        <img class="imagen" src="" alt="">
                        <p class="fechaBlog">February 19, 2023</p>
                        <h4 class="tituloBlog">Miami</h4>
                        <p class="textoBlog">Miami, in the United States, is known for its vibrant art scene, beautiful beaches, and cultural diversity. It's a dynamic city that fuses culture and coastal charm.</p>
                        <div class="cajaBoton">
                            <p class="textoBoton">Read Full</p>
                            <img src="icon-arrow-right.svg" alt="">                            
                        </div>
                    </div>
                    <div class="cajaBlog">
                        <img class="imagen" src="" alt="">
                        <p class="fechaBlog">June 3, 2022</p>
                        <h4 class="tituloBlog">New York</h4>
                        <p class="textoBlog">New York City, in the USA, is renowned for its iconic skyline, featuring landmarks like Central Park, diverse neighborhoods, and its status as a global cultural and business hub.</p>
                        <div class="cajaBoton">
                            <p class="textoBoton">Read Full</p>
                            <img src="icon-arrow-right.svg" alt="">                            
                        </div>
                    </div>
                </section>
                <button class="botonMore">SEE MORE</button>
            </section>
        </template>
    </div>

    <div id="footer">
        <template id="menu_inferior">
            <footer class="caja_menu_inferior">
                <img class="logo_footer" src="logo.svg" alt="">
                <div class="footer_flex">
                    <p class="texto_footer">Copyright 2022 DELLAFUENTESL.</p>
                    <a href="#"><button class="boton_footer">Privacy Policy</button></a>
                    <a href="#"><button class="boton_footer">Terms & Conditions</button></a>
                    <a href="#"><button class="boton_footer">Cookie Policy</button></a>
                    <a href="#"><button class="boton_footer">Contact</button></a>
                </div>
            </footer>
        </template>
    </div>

</body>
</html>

<script>
    element = document.createElement("menu_superior");
    element = menu_superior.content.cloneNode(true);

    document.getElementById("menu").append(element);

    element = document.createElement("foto_principal");
    element = foto_principal.content.cloneNode(true);

    document.getElementById("page_content").append(element);

    element = document.createElement("ultims_blogs");
    element = ultims_blogs.content.cloneNode(true);

    img = element.querySelector(".img");
    img.src = "https://picsum.photos/716/534";

    imagenes = element.querySelectorAll(".imagen");
    imagenes.forEach(element => {
        element.src = "https://picsum.photos/263/159";
    });

    document.getElementById("page_content").append(element);

    element = document.createElement("blogs_visitados");
    element = blogs_visitados.content.cloneNode(true);

    imagenes = element.querySelectorAll(".imagen");
    imagenes.forEach(element => {
        element.src = "https://picsum.photos/401/344";
    });
    
    document.getElementById("page_content").append(element);

    element = document.createElement("menu_inferior");
    element = menu_inferior.content.cloneNode(true);

    document.getElementById("footer").append(element);

</script>