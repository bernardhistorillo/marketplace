@extends('layouts.app')

@section('title', 'Artists')
@section('og_title', 'Artists')
@section('og_image', asset('img/og/home.png'))

@section('content')
    <div class="page-min-height w-100 bg-color-7 pb-5" style="padding-top:80px">
        <div class="container py-4 py-md-5">
            <div class="rubik-bold text-center text-white font-size-240 font-size-md-300 pt-4 pb-2 py-md-3 mb-5" style="letter-spacing:0.05em">MEET OUR ARTISTS</div>

            <div class="row px-0">
                <div class="col-md-6 col-lg-4 px-4 mb-5">
                    <div class="position-relative overflow-hidden artist-card">
                        <img src="{{ asset('img/artists/dan-3.webp') }}" class="w-100 mb-5 mb-md-0" alt="Dan Vincent Barotilla" />

                        <div class="position-absolute w-100 px-4 py-4 d-none d-md-block" style="top:0; left:0">
                            <p class="neo-black text-white font-size-230 line-height-110 letter-spacing-5 mb-1">Dan Vincent Barotilla</p>
                            <p class="neo-regular-italic text-white font-size-180 line-height-130 letter-spacing-5">Visual Artist</p>
                        </div>

                        <div class="position-absolute w-100 px-3 px-xl-4 py-3 py-lg-4 artist-description overflow-auto" style="max-height:100%; left:0; background-color:rgba(52,49,49,0.85); transition:0.5s; z-index:1">
                            <p class="text-center cursor-pointer d-block d-md-none hide-artist-description">
                                <i class="fas fa-chevron-down text-white font-size-150"></i>
                            </p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130">Dan Vincent Barotilla is an artist that admits he doesn’t have any art style because his painting technique constantly evolves. Born and raised in Legazpi City, he cites Salvador Dali, Rodel Tapaya, and Ronald Ventura as some of the artists that he look up to.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130">One interesting fact about Barotilla is how he discovered his love for painting. He flipped through a calendar with paintings of national art competition winners for students and that prompted him to start his career as an artist. With his passion and skills, he won 1st place in an on-the-spot painting competition during a local festival in the province.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130 mb-0">Barotilla believes that tokenizing physical art is the next big step artists should take, emphasizing that NFTs are the future of art.</p>
                        </div>

                        <div class="position-absolute d-block d-md-none bg-white px-4 py-3 w-100" style="bottom:0; left:0">
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <p class="neo-black font-size-130 mb-0">Dan Vincent Barotilla</p>
                                    <p class="neo-regular-italic font-size-120 mb-0">Visual Artist</p>
                                </div>

                                <div class="flex-fill" style="min-width:100px">
                                    <div class="d-flex flex-wrap justify-content-end">
                                        <div class="p-2">
                                            <a href="https://www.artstation.com/sphinx1232" target="_blank">
                                                <i class="fab fa-artstation text-color-2 font-size-110"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="neo-bold font-size-110 cursor-pointer mb-0 show-artist-description">Read More&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></p>

                            <div class="p-2 mt-2">
                                <a href="{{ route('collection.index', 'oha') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center flex-wrap mt-3">
                                <div class="me-4">
                                    <a href="https://www.artstation.com/sphinx1232" target="_blank">
                                        <i class="fab fa-artstation text-white font-size-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('collection.index', 'oha') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 px-4 mb-5">
                    <div class="position-relative overflow-hidden artist-card">
                        <img src="{{ asset('img/artists/glenn-3.webp') }}" class="w-100 mb-5 mb-md-0" alt="Glenn De Guzman" />

                        <div class="position-absolute w-100 px-4 py-4 d-none d-md-block" style="top:0; left:0">
                            <p class="neo-black text-white font-size-230 line-height-110 letter-spacing-5 mb-1">Glenn De Guzman</p>
                            <p class="neo-regular-italic text-white font-size-180 line-height-130 letter-spacing-5">Visual Artist</p>
                        </div>

                        <div class="position-absolute w-100 px-3 px-xl-4 py-3 py-lg-4 artist-description overflow-auto" style="max-height:100%; background-color:rgba(52,49,49,0.85); transition:0.5s; z-index:1">
                            <p class="text-center cursor-pointer d-block d-md-none hide-artist-description">
                                <i class="fas fa-chevron-down text-white font-size-150"></i>
                            </p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130">Glenn De Guzman describes his art style as surrealism and social realism expressing his emotions, goals, and ideas in the realm of personal, social, and political issues. He is a resident of Bacacay, Albay who finished his Fine Arts Major in Painting at the University of Santo Tomas, Manila back in 1992.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130">He won first Hon. Mention during the 12th PLDT-DPC Visual Art National Competition and already had his first exhibit at R Gallery last year. Some of his inspirations are Gustav Klimt, Salvador Dali, Renato Habulan, and Neil Doloricon.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130 mb-0">De Guzman is looking forward to showing other artists endless possibilities and opportunities through NFTs.</p>
                        </div>

                        <div class="position-absolute d-block d-md-none bg-white px-4 py-3 w-100" style="bottom:0; left:0">
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <p class="neo-black font-size-130 mb-0">Glenn De Guzman</p>
                                    <p class="neo-regular-italic font-size-120 mb-0">Visual Artist</p>
                                </div>

                                <div class="flex-fill" style="min-width:100px">
                                    <div class="d-flex flex-wrap justify-content-end">
                                        <div class="p-2">
                                            <a href="https://web.facebook.com/glenn.deguzman.92" target="_blank">
                                                <i class="fab fa-facebook-f text-color-2 font-size-110"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="neo-bold font-size-110 cursor-pointer mb-0 show-artist-description">Read More&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></p>

                            <div class="p-2 mt-2">
                                <a href="{{ route('collection.index', 'oha') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center flex-wrap mt-3">
                                <div class="me-4">
                                    <a href="https://web.facebook.com/glenn.deguzman.92" target="_blank">
                                        <i class="fab fa-facebook-f text-white font-size-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('collection.index', 'oha') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 px-4 mb-5">
                    <div class="position-relative overflow-hidden artist-card">
                        <img src="{{ asset('img/artists/mel-3.webp') }}" class="w-100 mb-5 mb-md-0" alt="Mel Baranda" />

                        <div class="position-absolute w-100 px-4 py-4 d-none d-md-block" style="top:0; left:0">
                            <p class="neo-black text-white font-size-230 line-height-110 letter-spacing-5 mb-1">Mel Baranda</p>
                            <p class="neo-regular-italic text-white font-size-180 line-height-130 letter-spacing-5">Visual Artist</p>
                        </div>

                        <div class="position-absolute w-100 px-3 px-xl-4 py-3 py-lg-4 artist-description overflow-auto" style="max-height:100%; background-color:rgba(52,49,49,0.85); transition:0.5s; z-index:1">
                            <p class="text-center cursor-pointer d-block d-md-none hide-artist-description">
                                <i class="fas fa-chevron-down text-white font-size-150"></i>
                            </p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130">Camelo “Mel” Baranda is an artist from Bacacay, Albay. This painter, who has been part of over ten exhibits, developed his early love for drawing upon the sight of characters in now-defunct Pinoy Komiks.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130">He pursued BSFA at UST-Legazpi and worked as a freelance Cleanup In-Betweener in animation. Later on, he discovered that his passion still gravitates toward his childhood imaginations and discoveries.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130 mb-0">Inspired by Salvador Dali, Vincent VanGogh, Luis Royo, and Glenn de Guzman, he describes his art style as a mixture of surrealism and social realism. Using oil paint as his medium, his artworks tend to go towards themes such as nature and society, focusing on social conflicts and political injustices.</p>
                        </div>

                        <div class="position-absolute d-block d-md-none bg-white px-4 py-3 w-100" style="bottom:0; left:0">
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <p class="neo-black font-size-130 mb-0">Mel Baranda</p>
                                    <p class="neo-regular-italic font-size-120 mb-0">Visual Artist</p>
                                </div>

                                <div class="flex-fill" style="min-width:100px">
                                    <div class="d-flex flex-wrap justify-content-end">
                                        <div class="p-2">
                                            <a href="https://web.facebook.com/melbaranda007" target="_blank">
                                                <i class="fab fa-facebook-f text-color-2 font-size-110"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="neo-bold font-size-110 cursor-pointer mb-0 show-artist-description">Read More&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></p>

                            <div class="p-2 mt-2">
                                <a href="{{ route('collection.index', 'oha') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center flex-wrap mt-3">
                                <div class="me-4">
                                    <a href="https://web.facebook.com/melbaranda007" target="_blank">
                                        <i class="fab fa-facebook-f text-white font-size-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('collection.index', 'oha') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 px-4 mb-5">
                    <div class="position-relative overflow-hidden artist-card">
                        <img src="{{ asset('img/artists/Marso.jpg') }}" class="w-100 mb-5 mb-md-0" alt="Marso" />

                        <div class="position-absolute w-100 px-4 py-4 d-none d-md-block" style="top:0; left:0">
                            <p class="neo-black text-white font-size-230 line-height-110 letter-spacing-5 mb-1">Marso</p>
                            <p class="neo-regular-italic text-white font-size-180 line-height-130 letter-spacing-5">Illustrator</p>
                        </div>

                        <div class="position-absolute w-100 px-3 px-xl-4 py-3 py-lg-4 artist-description overflow-auto" style="max-height:100%; background-color:rgba(52,49,49,0.85); transition:0.5s; z-index:1">
                            <p class="text-center cursor-pointer d-block d-md-none hide-artist-description">
                                <i class="fas fa-chevron-down text-white font-size-150"></i>
                            </p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130">Marso is a fine arts graduate at the Technological University of the Philippines. She has been a graphic designer and graphic artist for 8 years, specializing in illustrations, merch, and packaging designs.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130 mb-0">Marso describes her art style as candy-colored kaleidoscopic fractal figures of geometric and polygonal vectors. Her art is usually psychedelic-themed and she believes that there’s energy in flowing lines and colors which gives out the visual value of happiness.</p>
                        </div>

                        <div class="position-absolute d-block d-md-none bg-white px-4 py-3 w-100" style="bottom:0; left:0">
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <p class="neo-black font-size-130 mb-0">Marso</p>
                                    <p class="neo-regular-italic font-size-120 mb-0">Illustrator</p>
                                </div>

                                <div class="flex-fill" style="min-width:100px">
                                    <div class="d-flex flex-wrap justify-content-end">
                                        <div class="p-2">
                                            <a href="http://www.marso63.art" target="_blank">
                                                <i class="fas fa-globe text-color-2 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.facebook.com/pxzmarso" target="_blank">
                                                <i class="fab fa-facebook-f text-color-2 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://twitter.com/marso_63" target="_blank">
                                                <i class="fab fa-twitter text-color-2 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.instagram.com/marso.63/" target="_blank">
                                                <i class="fab fa-instagram text-color-2 font-size-110"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="neo-bold font-size-110 cursor-pointer mb-0 show-artist-description">Read More&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></p>

                            <div class="p-2 mt-2">
                                <a href="{{ route('collection.index', 'genesisblock') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center flex-wrap mt-3">
                                <div class="me-4">
                                    <a href="http://www.marso63.art" target="_blank">
                                        <i class="fas fa-globe text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://www.facebook.com/pxzmarso" target="_blank">
                                        <i class="fab fa-facebook-f text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://twitter.com/marso_63" target="_blank">
                                        <i class="fab fa-twitter text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://www.instagram.com/marso.63/" target="_blank">
                                        <i class="fab fa-instagram text-white font-size-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('collection.index', 'genesisblock') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 px-4 mb-5">
                    <div class="position-relative overflow-hidden artist-card">
                        <img src="{{ asset('img/artists/Dan-Barotilla.jpg') }}" class="w-100 mb-5 mb-md-0" alt="Boii Mustache" />

                        <div class="position-absolute w-100 px-4 py-4 d-none d-md-block" style="top:0; left:0">
                            <p class="neo-black text-white font-size-230 line-height-110 letter-spacing-5 mb-1">Boii Mustache</p>
                            <p class="neo-regular-italic text-white font-size-180 line-height-130 letter-spacing-5">Visual Artist</p>
                        </div>

                        <div class="position-absolute w-100 px-3 px-xl-4 py-3 py-lg-4 artist-description overflow-auto" style="max-height:100%; background-color:rgba(52,49,49,0.85); transition:0.5s; z-index:1">
                            <p class="text-center cursor-pointer d-block d-md-none hide-artist-description">
                                <i class="fas fa-chevron-down text-white font-size-150"></i>
                            </p>
                            <p class="text-white font-size-md-80 font-size-xl-100 font-size-xl-100 line-height-130">Boii Mustache is an Albay-based artist that uses different mediums in his works. His focus is on traditional painting, oils, pencils. does custom toys and also practices 3d digital art. His painting style is realism, mostly black and white paintings.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 font-size-xl-100 line-height-130 mb-0">His inspiration for his character is himself. Long haired raggedy guy with a mustache existing on different personalities. He also has done community-based mural projects along with different organizations. Joined mural and painting competitions and shows.</p>
                        </div>

                        <div class="position-absolute d-block d-md-none bg-white px-4 py-3 w-100" style="bottom:0; left:0">
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <p class="neo-black font-size-130 mb-0">Boii&nbsp;Mustache</p>
                                    <p class="neo-regular-italic font-size-120 mb-0">Visual&nbsp;Artist</p>
                                </div>

                                <div class="flex-fill" style="min-width:100px">
                                    <div class="d-flex flex-wrap justify-content-end">
                                        <div class="p-2">
                                            <a href="https://twitter.com/BoiiMustache" target="_blank">
                                                <i class="fab fa-twitter text-color-2 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.instagram.com/mustache.boii/" target="_blank">
                                                <i class="fab fa-instagram text-color-2 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.artstation.com/sphinx1232" target="_blank">
                                                <i class="fab fa-artstation text-color-2 font-size-110"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="neo-bold font-size-110 cursor-pointer mb-0 show-artist-description">Read More&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></p>

                            <div class="p-2 mt-2">
                                <a href="{{ route('collection.index', 'mustachios') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center flex-wrap mt-3">
                                <div class="me-4">
                                    <a href="https://twitter.com/BoiiMustache" target="_blank">
                                        <i class="fab fa-twitter text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://www.instagram.com/mustache.boii/" target="_blank">
                                        <i class="fab fa-instagram text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://www.artstation.com/sphinx1232" target="_blank">
                                        <i class="fab fa-artstation text-white font-size-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('collection.index', 'mustachios') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 px-4 mb-5">
                    <div class="position-relative overflow-hidden artist-card">
                        <img src="{{ asset('img/artists/Eugene-Oligo.jpg') }}" class="w-100 mb-5 mb-md-0" alt="Eugene Oligo" />

                        <div class="position-absolute w-100 px-4 py-4 d-none d-md-block" style="top:0; left:0">
                            <p class="neo-black text-white font-size-230 line-height-110 letter-spacing-5 mb-1">Eugene Oligo</p>
                            <p class="neo-regular-italic text-white font-size-180 line-height-130 letter-spacing-5">Concept Artist</p>
                        </div>

                        <div class="position-absolute w-100 px-3 px-xl-4 py-3 py-lg-4 artist-description overflow-auto" style="max-height:100%; background-color:rgba(52,49,49,0.85); transition:0.5s; z-index:1">
                            <p class="text-center cursor-pointer d-block d-md-none hide-artist-description">
                                <i class="fas fa-chevron-down text-white font-size-150"></i>
                            </p>
                            <p class="text-white font-size-md-80 font-size-xl-100 font-size-xl-100 line-height-130">Eugene is a multimedia artist that focuses on digital illustrations, digital painting, concept art 2D and 3D. He also creates traditional artworks such as paintings, portraits and so on.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 font-size-xl-100 line-height-130 mb-0">He served many clients locally, nationally and internationally. He had a collaboration project with Titus pens, and was invited to be a guest artist to make doodle wall art with other artists.</p>
                        </div>

                        <div class="position-absolute d-block d-md-none bg-white px-4 py-3 w-100" style="bottom:0; left:0">
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <p class="neo-black font-size-130 mb-0">Eugene&nbsp;Oligo</p>
                                    <p class="neo-regular-italic font-size-120 mb-0">Concept&nbsp;Artist</p>
                                </div>

                                <div class="flex-fill" style="min-width:100px">
                                    <div class="d-flex flex-wrap justify-content-end">
                                        <div class="p-2">
                                            <a href="https://web.facebook.com/chenandink" target="_blank">
                                                <i class="fab fa-facebook-f text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.instagram.com/chenandink/" target="_blank">
                                                <i class="fab fa-instagram text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.chenandink.com/" target="_blank">
                                                <i class="fas fa-globe text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="neo-bold font-size-110 cursor-pointer mb-0 show-artist-description">Read More&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></p>

                            <div class="p-2 mt-2">
                                <a href="{{ route('collection.index', 'titansofindustry') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center flex-wrap mt-3">
                                <div class="me-4">
                                    <a href="https://web.facebook.com/eugene.delacroixii" target="_blank">
                                        <i class="fab fa-facebook-f text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://www.instagram.com/eugene_dlcrx/" target="_blank">
                                        <i class="fab fa-instagram text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://edlcrx.artstation.com/" target="_blank">
                                        <i class="fab fa-artstation text-white font-size-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('collection.index', 'titansofindustry') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 px-4 mb-5">
                    <div class="position-relative overflow-hidden artist-card">
                        <img src="{{ asset('img/artists/Lei-Melendres.jpg') }}" class="w-100 mb-5 mb-md-0" alt="Lei Melendres" />

                        <div class="position-absolute w-100 px-4 py-4 d-none d-md-block" style="top:0; left:0">
                            <p class="neo-black text-white font-size-230 line-height-110 letter-spacing-5 mb-1">Lei Melendres</p>
                            <p class="neo-regular-italic text-white font-size-180 line-height-130 letter-spacing-5">Doodle Artist</p>
                        </div>

                        <div class="position-absolute d-block d-md-none bg-white px-4 py-3 w-100" style="bottom:0; left:0">
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <p class="neo-black font-size-130 mb-0">Lei&nbsp;Melendres</p>
                                    <p class="neo-regular-italic font-size-120 mb-0">Doodle&nbsp;Artist</p>
                                </div>

                                <div class="flex-fill" style="min-width:100px">
                                    <div class="d-flex flex-wrap justify-content-end">
                                        <div class="p-2">
                                            <a href="https://web.facebook.com/leimelendresdoodles" target="_blank">
                                                <i class="fab fa-facebook-f text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.instagram.com/leimelendres/" target="_blank">
                                                <i class="fab fa-instagram text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://twitter.com/LeiMelendres" target="_blank">
                                                <i class="fab fa-twitter text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.behance.net/leimelendres" target="_blank">
                                                <i class="fab fa-behance text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.deviantart.com/leimelendres" target="_blank">
                                                <i class="fab fa-deviantart text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.youtube.com/c/leimelendres" target="_blank">
                                                <i class="fab fa-youtube text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="neo-bold font-size-110 cursor-pointer mb-0 show-artist-description">Read More&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></p>

                            <div class="p-2 mt-2">
                                <a href="{{ route('collection.index', 'inkvadyrz') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>

                        <div class="position-absolute w-100 px-3 px-xl-4 py-3 py-lg-4 artist-description overflow-auto" style="max-height:100%; background-color:rgba(52,49,49,0.85); transition:0.5s; z-index:1">
                            <p class="text-center cursor-pointer d-block d-md-none hide-artist-description">
                                <i class="fas fa-chevron-down text-white font-size-150"></i>
                            </p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130">Lei is a multi-faceted artist. Although his main focus is digital illustration, he also includes traditional illustration, mural work, product design, and toy customization in his services.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130">He coined a term for his art style. He named it “Infinity Mix” because of the mixture of endless elements and details interacting together to form a scene.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130 mb-0">Lei served multiple local and international clients. He has worked with NBA Store, Samsonite Red Philippines, Capital PH, Rhinoshield, Asus PH, Coffee Bean & Tea Leaf, Kipling, Lazada SG, G-Shock PH, Globe, Daniel Wellington, WWF Philippines.</p>
                        </div>
                    </div>

                    <div class="d-none d-md-block">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center flex-wrap mt-3">
                                <div class="me-4">
                                    <a href="https://web.facebook.com/leimelendresdoodles" target="_blank">
                                        <i class="fab fa-facebook-f text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://www.instagram.com/leimelendres/" target="_blank">
                                        <i class="fab fa-instagram text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://twitter.com/LeiMelendres" target="_blank">
                                        <i class="fab fa-twitter text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://www.behance.net/leimelendres" target="_blank">
                                        <i class="fab fa-behance text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://www.deviantart.com/leimelendres" target="_blank">
                                        <i class="fab fa-deviantart text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://www.youtube.com/c/leimelendres" target="_blank">
                                        <i class="fab fa-youtube text-white font-size-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('collection.index', 'inkvadyrz') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 px-4 mb-5">
                    <div class="position-relative overflow-hidden artist-card">
                        <img src="{{ asset('img/artists/Chen-Naje.jpg') }}" class="w-100 mb-5 mb-md-0" alt="Chen Naje" />

                        <div class="position-absolute w-100 px-4 py-4 d-none d-md-block" style="top:0; left:0">
                            <p class="neo-black text-white font-size-230 line-height-110 letter-spacing-5 mb-1">Chen Naje</p>
                            <p class="neo-regular-italic text-white font-size-180 line-height-130 letter-spacing-5">Ink Illustrator</p>
                        </div>

                        <div class="position-absolute w-100 px-3 px-xl-4 py-3 py-lg-4 artist-description overflow-auto" style="max-height:100%; background-color:rgba(52,49,49,0.85); transition:0.5s; z-index:1">
                            <p class="text-center cursor-pointer d-block d-md-none hide-artist-description">
                                <i class="fas fa-chevron-down text-white font-size-150"></i>
                            </p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130">John Kaizen “Chen” Naje, also known as “Chenandink” within the art community, is an artist based in Camalig, Albay, Philippines. With over 40,000 followers in his Instagram account, Chen is one of Bicol’s pride when it comes to art and illustration.</p>
                            <p class="text-white font-size-md-80 font-size-xl-100 line-height-130 mb-0">He is recognized for creating detailed illustrations of nature and wildlife using pen and ink. With his Bachelor's Degree in Fine Arts and extensive experience in making illustrations, he has landed multiple commissions for private individuals and collectors around the world.</p>
                        </div>

                        <div class="position-absolute d-block d-md-none bg-white px-4 py-3 w-100" style="bottom:0; left:0">
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <p class="neo-black font-size-130 mb-0">Chen&nbsp;Naje</p>
                                    <p class="neo-regular-italic font-size-120 mb-0">Ink&nbsp;Illustrator</p>
                                </div>

                                <div class="flex-fill" style="min-width:100px">
                                    <div class="d-flex flex-wrap justify-content-end">
                                        <div class="p-2">
                                            <a href="https://web.facebook.com/chenandink" target="_blank">
                                                <i class="fab fa-facebook-f text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.instagram.com/chenandink/" target="_blank">
                                                <i class="fab fa-instagram text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <a href="https://www.chenandink.com/" target="_blank">
                                                <i class="fas fa-globe text-color-6 font-size-110"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="neo-bold font-size-110 cursor-pointer mb-0 show-artist-description">Read More&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></p>

                            <div class="p-2 mt-2">
                                <a href="{{ route('collection.index', 'cryptosolitaire') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center flex-wrap mt-3">
                                <div class="me-4">
                                    <a href="https://web.facebook.com/chenandink" target="_blank">
                                        <i class="fab fa-facebook-f text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://www.instagram.com/chenandink/" target="_blank">
                                        <i class="fab fa-instagram text-white font-size-180"></i>
                                    </a>
                                </div>
                                <div class="me-4">
                                    <a href="https://www.chenandink.com/" target="_blank">
                                        <i class="fas fa-globe text-white font-size-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('collection.index', 'cryptosolitaire') }}" class="nav-link btn btn-custom-1 px-sm-3 py-1 py-sm-2 font-size-80 font-size-sm-90 line-height-120" style="border-radius:40px">Visit NFT Collection</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center font-size-160 text-white letter-spacing-5 pt-3">MORE ARTISTS COMING SOON..</div>
        </div>
    </div>
@endsection
