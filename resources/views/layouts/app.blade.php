<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
    @include('partials.app.header')
</head>

<body id="body">

    {{-- Navigation Bar --}}
    @include('partials.app.navbar')

    {{-- Above The Fold Hero Section --}}
    @include('content.app.hero')

    {{-- About Us Section --}}
    @include('content.app.about')

    {{-- Feature Section --}}
    @include('content.app.feature')

    {{-- Service Section --}}
    @include('content.app.service')

    {{-- Call To Action Section --}}
    @include('content.app.calltoaction')
    
    <!-- Content Start -->
    <section class="testimonial">
        <div class="container">
            <div class="row">
                <div class="section-title text-center">
                    <h2>Fun Facts About Us</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia
                        and Consonantia,
                        <br>there live the blind texts. Separated they live in Bookmarksgrove right
                    at the coast of the Semantics</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="block">
                        <ul class="counter-box clearfix">
                            <li>
                                <div class="counter-item"> <i class="ion-ios-chatboxes-outline"></i>
                                    <h4 class="count" data-count="99">0</h4>
                                    <span>Cups Of Coffee</span>
                                </div>
                            </li>
                            <li>
                                <div class="counter-item"> <i class="ion-ios-glasses-outline"></i>
                                    <h4 class="count" data-count="45">0</h4>
                                    <span>Article Written</span>
                                </div>
                            </li>
                            <li>
                                <div class="counter-item"> <i class="ion-ios-compose-outline"></i>
                                    <h4 class="count" data-count="125">0</h4>
                                    <span>Projects Completed</span>
                                </div>
                            </li>
                            <li>
                                <div class="counter-item"> <i class="ion-ios-timer-outline"></i>
                                    <h4 class="count" data-count="200">0</h4>
                                    <span>Combined Projects</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 offset-md-1">
                    <div class="testimonial-carousel text-center">
                        <div class="testimonial-slider owl-carousel">
                            <div> <i class="ion-quote"></i>
                                <p>&quot;This Company created an e-commerce site with the tools to make our
                                    business a success, with innovative ideas we feel that our site has unique
                                elements that make us stand out from the crowd.&quot;</p>
                                <div class="user">
                                    <img src="images/item-img1.jpg" alt="Pepole">
                                    <p><span>Rose Ray</span> CEO-Themefisher</p>
                                </div>
                            </div>
                            <div> <i class="ion-quote"></i>
                                <p>&quot;This Company created an e-commerce site with the tools to make our
                                    business a success, with innovative ideas we feel that our site has unique
                                elements that make us stand out from the crowd.&quot;</p>
                                <div class="user">
                                    <img src="images/item-img1.jpg" alt="Pepole">
                                    <p><span>Rose Ray</span> CEO-Themefisher</p>
                                </div>
                            </div>
                            <div> <i class="ion-quote"></i>
                                <p>&quot;This Company created an e-commerce site with the tools to make our
                                    business a success, with innovative ideas we feel that our site has unique
                                elements that make us stand out from the crowd.&quot;</p>
                                <div class="user">
                                    <img src="images/item-img1.jpg" alt="Pepole">
                                    <p><span>Rose Ray</span> CEO-Themefisher</p>
                                </div>
                            </div>
                            <div> <i class="ion-quote"></i>
                                <p>&quot;This Company created an e-commerce site with the tools to make our
                                    business a success, with innovative ideas we feel that our site has unique
                                elements that make us stand out from the crowd.&quot;</p>
                                <div class="user">
                                    <img src="images/item-img1.jpg" alt="Pepole">
                                    <p><span>Rose Ray</span> CEO-Themefisher</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Footer --}}
    @include('partials.app.footer')
    {{-- App Scripts --}}
    @include('partials.app.scripts')

</body>

</html>
