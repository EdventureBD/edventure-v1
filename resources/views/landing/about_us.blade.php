<x-landing-layout>
    @include('landing.header')
    <section class="header-banner pt-7">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 py-5">
                    <div class="pl-3">
                        <h3 class="text-purple text-lg font-bebas">WHO WE ARE</h3>
                        <p class="fw-600 text-xsm max-w-38 w-100 text-purple-half">A group of passionate educators striving to make 
                            education easy, fun, and personal with the help of technology. We want to increase the accessibility of quality
                             education while empowering learners, parents, and teachers alike.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="/img/about/aboutus.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section> <!--header banner end-->
    <div class="container-fluid">
        <img src="/img/about/process.png" class="img-fluid" alt="">
    </div>

    <div class="our-exams-section text-center py-5">
        <div class="container">
            <h3 class="text-purple text-lg font-bebas">THE EDVENTURE MANIFESTO</h3>
            <p class="fw-600 text-xsm max-w-38 w-100 mx-auto text-purple-half">A group of passionate educators striving to make education easy, 
                fun, and personal with the help of technology.</p>
            <div class="row my-5">
                <div class="col-md-4">
                    <div class="single-exam h-30 p-4">
                        <img src="/img/about/pa.png" class="img-fluid"  alt="">
                        <h5 class="text-sm fw-800 mt-3 text-purple">Personal Assistance</h5>
                        <p class="text-xxsm fw-400 mt-3 text-purple-half">We focus on personalized assistance over personalized education</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-exam h-30 p-4">
                        <img src="/img/about/sc.png" class="img-fluid" alt="">
                        <h5 class="text-sm fw-800 mt-3 text-purple">Seamless communication</h5>
                        <p class="text-xxsm fw-400 mt-3 text-purple-half">Ensuring seamless communication between students and teachers is more important to us than sticking to one platform or device</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-exam h-30  p-4">
                        <img src="/img/about/te.png" class="img-fluid" alt="">
                        <h5 class="text-sm fw-800 mt-3 text-purple">Time Efficiency</h5>
                        <p class="text-xxsm fw-400 mt-3 text-purple-half">Following a rigid schedule for the sake of routine seems useless to us without the best possible use of the time</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- manifesto section end -->

    <div class="">
        <img src="/img/about/ecosystem.png" class="w-100 img-fluid" alt="">
    </div>

    <div class="our-exams-section py-5">
        <div class="container">
            
            <div class="row my-5">
                <div class="col-md-3">
                    <div class="single-author">
                        <img src="/img/about/shahriar.png" class="img-fluid"  alt="">
                        <div class="social-icons d-flex justify-content-between">
                            <a href="#"><img src="/img/about/facebook.png" class="img-fluid"  alt=""></a>
                            <a href="#"><img src="/img/about/instagram.png" class="img-fluid"  alt=""></a>
                            <a href="#"><img src="/img/about/twitter.png" class="img-fluid"  alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 pl-3 pl-md-5">
                    <h3 class="text-purple text-lg font-bebas">MESSAGE FROM THE CEO</h3>
                    <p class="fw-600 text-xsm w-100 text-purple-half">Growing up in a country with the highest population density and inadequate resources often leads me to think of alternative solutions to existing problems. The education system of Bangladesh is one of the prime sufferers of the population and resource problem we have in general. Online learning, in this context, comes with a lot of opportunities to be explored. However, as though the term “online learning” sounds really promising in trying to solve the resource problem we have, finding out what works out and what doesn’t in an online learning module is really critical. We, in Edventure, believe online learning to be a facilitator of the existing learning eco-system, not a replacement. Learning is an inter-connected process comprising the student, teacher and guardian where we believe spontaneous participation of every stakeholder is extremely important. Our primary mission is to build an eco-system where all the stakeholders are empowered to spontaneously participate in the learning journey by enabling them with necessary resources and relevant modern technologies. Edventure, in a nutshell, is a group of passionate educators and tech professionals who strive to translate their experiences as both student and teacher into the service we are going to offer in order to make education in general easy, fun and personal”                        
                    </p>
                </div>
            </div>
            
        </div>
    </div> <!-- ceo section end -->

    @include('landing.footer')
</x-landing-layout>


