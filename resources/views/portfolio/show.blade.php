@extends('layouts.app')

@section('title', $image->title)

@section('content')

    <section class="portfolio-single-page section-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <img src="{{ $image->fullPath }}" class="img-fluid h-50" alt="">
                </div>
                <div class="col-md-4">
                    <div class="project-details mt-50">
                        <h4>Project Details</h4>
                        <ul>
                            <li><span><i class="fa fa-shirtsinbulk "></i> Client</span><strong>Jannie Kelonsky</strong></li>
                            <li><span><i class="fa fa-shield "></i> What We Did</span><strong>Website Redesign</strong></li>
                            <li><span><i class="fa fa-ils "></i> Tools Used</span><strong>Photoshop,Illustrator</strong></li>
                            <li><span><i class="icon-calendar3"></i>Completed on:</span> 17th March 2014</li>
                            <li><span><i class="icon-lightbulb"></i>Skills:</span> HTML5 / PHP / CSS3</li>
                            <li><span><i class="icon-link"></i>Client:</span> <a href="#">Google</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="project-content mt-50">
                        <h2>Behance Website Redesign</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas officiis cumque, harum dicta necessitatibus
                            reprehenderit, delectus molestiae, impedit alias adipisci distinctio voluptas. Tempora modi amet voluptate
                            at provident soluta consequatur.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quibusdam sed, neque recusandae, est
                            odit. A facere tempore soluta laborum.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, rem eaque facilis. Sit, voluptas?
                            Error soluta odio, harum tenetur, alias in iure ipsam blanditiis illo, ratione, magnam a minima incidunt!
                            Suscipit facilis, ut maxime libero necessitatibus, rerum aut voluptates aliquam maiores iusto qui
                            temporibus nesciunt, incidunt in quasi. Veniam aliquid ea aperiam, obcaecati voluptate ab, temporibus
                            fugiat at, inventore molestiae quibusdam, modi numquam debitis libero aut eum. Architecto sit quia quidem
                            odit, quasi eveniet reprehenderit rerum dolorem voluptate sed aspernatur numquam enim, adipisci iste optio
                            ea libero laboriosam praesentium aperiam nobis vero tempore consequuntur sapiente eos at. Suscipit quis
                            voluptatibus temporibus dolore consectetur ex excepturi adipisci sunt. Maxime aperiam eos illum minima
                            aliquid voluptate autem qui at impedit recusandae earum possimus, alias, maiores sint, sed quia quis aut
                            cupiditate voluptatem reiciendis. Facilis nobis assumenda totam officiis dicta autem dolorem quidem
                            similique, delectus rerum laborum veritatis, cum magnam dignissimos necessitatibus possimus error, eius
                            omnis veniam culpa, porro officia adipisci exercitationem minus hic. Ipsum veritatis repudiandae nulla quo
                            dicta voluptates tenetur mollitia perferendis sequi, magnam doloremque odit similique, sit, voluptas unde
                            iste molestias. Accusantium, corporis quibusdam quod in animi earum alias autem ipsum. Eaque rem numquam
                            delectus veniam commodi doloribus consequatur deleniti?</p>
                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/LKFuXETZUsI" frameborder="0"
                                allowfullscreen></iframe>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores neque vero quasi quisquam atque in,
                            libero ab sunt eius! Nesciunt laboriosam alias corporis sit accusantium voluptate sapiente debitis quos
                            mollitia saepe maxime ipsum facilis dolore voluptas inventore veniam deleniti, eligendi harum aperiam iusto
                            culpa? Delectus dolorum facere quasi iure explicabo?</p>
                    </div>
                </div>
                <div class="col-md-5">

                </div>
            </div>

        </div>
    </section>

@endsection
