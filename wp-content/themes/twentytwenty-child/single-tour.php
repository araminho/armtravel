<?php

get_header();

$tags  = get_the_terms( $id, 'post_tag');
//echo "<pre>"; print_r($tags); exit;
?>

    <main>
        <div class="img-bg-container">
            <img src="images/img_bg.png" alt="">
            <div class="shadow"></div>
        </div>
        <div class="horizontal-line"></div>
        <div class="tour-container">
            <div class="container-with-bg container-padding container-title">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="description">
	                    <?php the_content(); ?>
                    </div>
                <?php endwhile; // end of the loop. ?>
            </div>

            <!--<div class="container-with-bg container-padding search-block-container">
                <div class="search-block">
                    <form class="search" action="">
                        <div class="price">
                            <div>
                                <input type="number" placeholder="1000" id="price-start" name="price-start">
                            </div>
                            <div>
                                <input type="number" placeholder="3000" id="price-to" name="price-to">
                            </div>
                        </div>
                        <div class="custom-select">
                            <select>
                                <option value="0">select option</option>
                                <option value="1" selected>check in-out</option>
                                <option value="2">Test</option>
                                <option value="3">Test</option>
                                <option value="4">Test</option>
                                <option value="5">Test</option>
                            </select>
                        </div>
                        <button class="btn-hover" type="submit">Search</button>
                    </form>
                </div>
            </div> -->
            <div class="container-with-bg container-padding tags-container">
                <form>
	                <?php foreach ($tags as $tag){ ?>
                        <div class="formrow">
                            <input class="checkbox" type="checkbox" name="check1" id="check1">
                            <label class="checklabel" for="check1"><?php echo $tag->name ?></label>
                        </div>
	                <?php } ?>
                </form>

            </div>
            <div class="container-with-bg tour-slider container-padding">
                <div class="info-block">
                    <div class="content">
                        <div class="title">
                            <span>Lorem Ipsum is simply industry's standard </span>
                        </div>
                        <div class="description">
                                <span>Lorem Ipsum is simply dummy text of the printing and typesetting ind
                                    Lorem Ipsum has been the industry's standard dummy Lorem Ipsum is
                                    dummy text of the printing and typesetting industry. Lorem Ipsum has
                                    industry's standard dummy</span>
                        </div>
                    </div>
                </div>
                <div class="slider-block">
                    <div class="slider">
                        <div class="slider-container tur-slider">
                            <div>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/img1.png" alt="">
                            </div>
                            <div>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/img3.png" alt="">
                            </div>
                            <div>
                                <video src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/vertical_video.mp4" controls></video>
                            </div>
                            <div>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/img3.png" alt="">
                            </div>
                            <div>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/img1.png" alt="">
                            </div>
                            <div>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/img3.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--<div class="container-padding tour-elements">
                <div class="tour-element">
                    <div class="title-block">
                        <div>
                            <span class="bold">Italy Skyline Tour</span>
                            <span class="bold">The best of Italy</span>
                        </div>
                        <div>
                            <span>146 Reviews</span>
                        </div>
                    </div>
                    <div class="image-block">
                        <img src="images/tours/package1.png" alt="">
                        <button class="price">$15</button>
                    </div>
                    <div class="description">
                            <span>Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum has been the industry's
                                standard dummy</span>
                    </div>
                    <div class="buttons">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24.063" height="24.003" viewBox="0 0 24.063 24.003">
                                <path id="Path_72" data-name="Path 72" d="M78.1,378.232c-6.307-2.436-7.4-3.467-7.585-3.747v-.727a7.917,7.917,0,0,0,1.617-2.98,2.537,2.537,0,0,0,.843-1.551,2.508,2.508,0,0,0-.4-1.755v-2.336c0-3.267-2.021-5.14-5.545-5.14-3.473,0-5.546,1.922-5.546,5.14v2.336a2.507,2.507,0,0,0-.4,1.752,2.541,2.541,0,0,0,.842,1.553,7.928,7.928,0,0,0,1.617,2.981v.728c-.208.323-1.362,1.341-7.584,3.746a1.517,1.517,0,0,0-.965,1.4v2.857A1.511,1.511,0,0,0,56.51,384H77.55a1.51,1.51,0,0,0,1.511-1.507v-2.857A1.515,1.515,0,0,0,78.1,378.232Zm-.455,4.26a.111.111,0,0,1-.092.121H56.51a.112.112,0,0,1-.093-.121l.068-2.973c6.983-2.7,8.189-3.846,8.451-4.686a.684.684,0,0,0,.03-.2V373.49a.689.689,0,0,0-.2-.48,6.516,6.516,0,0,1-1.534-2.816.687.687,0,0,0-.27-.38,1.165,1.165,0,0,1-.216-1.688.688.688,0,0,0,.154-.432v-2.558c0-2.456,1.427-3.754,4.127-3.754,2.738,0,4.127,1.263,4.127,3.754v2.557a.688.688,0,0,0,.153.431,1.169,1.169,0,0,1,.257.912,1.153,1.153,0,0,1-.473.778.7.7,0,0,0-.27.381,6.508,6.508,0,0,1-1.534,2.815.688.688,0,0,0-.2.48v1.142a.732.732,0,0,0,.03.2c.263.841,1.47,1.991,8.518,4.8Z" transform="translate(-54.998 -359.996)" fill="#868686" fill-rule="evenodd"/>
                            </svg>
                            <span>126 spaces left</span>
                        </div>
                        <button class="book btn-hover">Book Now</button>
                    </div>
                </div>
                <div class="tour-element">
                    <div class="title-block">
                        <div>
                            <span class="bold">Italy Skyline Tour</span>
                            <span class="bold">The best of Italy</span>
                        </div>
                        <div>
                            <span>146 Reviews</span>
                        </div>
                    </div>
                    <div class="image-block">
                        <img src="images/tours/package2.png" alt="">
                        <button class="price">$15</button>
                    </div>
                    <div class="description">
                            <span>Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum has been the industry's
                                standard dummy</span>
                    </div>
                    <div class="buttons">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24.063" height="24.003" viewBox="0 0 24.063 24.003">
                                <path id="Path_72" data-name="Path 72" d="M78.1,378.232c-6.307-2.436-7.4-3.467-7.585-3.747v-.727a7.917,7.917,0,0,0,1.617-2.98,2.537,2.537,0,0,0,.843-1.551,2.508,2.508,0,0,0-.4-1.755v-2.336c0-3.267-2.021-5.14-5.545-5.14-3.473,0-5.546,1.922-5.546,5.14v2.336a2.507,2.507,0,0,0-.4,1.752,2.541,2.541,0,0,0,.842,1.553,7.928,7.928,0,0,0,1.617,2.981v.728c-.208.323-1.362,1.341-7.584,3.746a1.517,1.517,0,0,0-.965,1.4v2.857A1.511,1.511,0,0,0,56.51,384H77.55a1.51,1.51,0,0,0,1.511-1.507v-2.857A1.515,1.515,0,0,0,78.1,378.232Zm-.455,4.26a.111.111,0,0,1-.092.121H56.51a.112.112,0,0,1-.093-.121l.068-2.973c6.983-2.7,8.189-3.846,8.451-4.686a.684.684,0,0,0,.03-.2V373.49a.689.689,0,0,0-.2-.48,6.516,6.516,0,0,1-1.534-2.816.687.687,0,0,0-.27-.38,1.165,1.165,0,0,1-.216-1.688.688.688,0,0,0,.154-.432v-2.558c0-2.456,1.427-3.754,4.127-3.754,2.738,0,4.127,1.263,4.127,3.754v2.557a.688.688,0,0,0,.153.431,1.169,1.169,0,0,1,.257.912,1.153,1.153,0,0,1-.473.778.7.7,0,0,0-.27.381,6.508,6.508,0,0,1-1.534,2.815.688.688,0,0,0-.2.48v1.142a.732.732,0,0,0,.03.2c.263.841,1.47,1.991,8.518,4.8Z" transform="translate(-54.998 -359.996)" fill="#868686" fill-rule="evenodd"/>
                            </svg>
                            <span>126 spaces left</span>
                        </div>
                        <button class="book btn-hover">Book Now</button>
                    </div>
                </div>
                <div class="tour-element">
                    <div class="title-block">
                        <div>
                            <span class="bold">Italy Skyline Tour</span>
                            <span class="bold">The best of Italy</span>
                        </div>
                        <div>
                            <span>146 Reviews</span>
                        </div>
                    </div>
                    <div class="image-block">
                        <img src="images/tours/package3.png" alt="">
                        <button class="price">$15</button>
                    </div>
                    <div class="description">
                            <span>Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum has been the industry's
                                standard dummy</span>
                    </div>
                    <div class="buttons">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24.063" height="24.003" viewBox="0 0 24.063 24.003">
                                <path id="Path_72" data-name="Path 72" d="M78.1,378.232c-6.307-2.436-7.4-3.467-7.585-3.747v-.727a7.917,7.917,0,0,0,1.617-2.98,2.537,2.537,0,0,0,.843-1.551,2.508,2.508,0,0,0-.4-1.755v-2.336c0-3.267-2.021-5.14-5.545-5.14-3.473,0-5.546,1.922-5.546,5.14v2.336a2.507,2.507,0,0,0-.4,1.752,2.541,2.541,0,0,0,.842,1.553,7.928,7.928,0,0,0,1.617,2.981v.728c-.208.323-1.362,1.341-7.584,3.746a1.517,1.517,0,0,0-.965,1.4v2.857A1.511,1.511,0,0,0,56.51,384H77.55a1.51,1.51,0,0,0,1.511-1.507v-2.857A1.515,1.515,0,0,0,78.1,378.232Zm-.455,4.26a.111.111,0,0,1-.092.121H56.51a.112.112,0,0,1-.093-.121l.068-2.973c6.983-2.7,8.189-3.846,8.451-4.686a.684.684,0,0,0,.03-.2V373.49a.689.689,0,0,0-.2-.48,6.516,6.516,0,0,1-1.534-2.816.687.687,0,0,0-.27-.38,1.165,1.165,0,0,1-.216-1.688.688.688,0,0,0,.154-.432v-2.558c0-2.456,1.427-3.754,4.127-3.754,2.738,0,4.127,1.263,4.127,3.754v2.557a.688.688,0,0,0,.153.431,1.169,1.169,0,0,1,.257.912,1.153,1.153,0,0,1-.473.778.7.7,0,0,0-.27.381,6.508,6.508,0,0,1-1.534,2.815.688.688,0,0,0-.2.48v1.142a.732.732,0,0,0,.03.2c.263.841,1.47,1.991,8.518,4.8Z" transform="translate(-54.998 -359.996)" fill="#868686" fill-rule="evenodd"/>
                            </svg>
                            <span>126 spaces left</span>
                        </div>
                        <button class="book btn-hover">Book Now</button>
                    </div>
                </div>-->
            </div>
        </div>
    </main>



<?php
get_footer();