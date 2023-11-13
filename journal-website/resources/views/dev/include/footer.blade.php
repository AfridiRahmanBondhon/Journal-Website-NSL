 <!-- ======= Footer ======= -->
 <footer id="footer">
     <div class="footer-top">
         <div class="container">
             <div class="row">

                 <div class="col-lg-4 col-md-6">
                     <div class="footer-info">
                         <h3>Nogor CSFD</h3>
                         <p class="pb-3"><em>Qui repudiandae et eum dolores alias sed ea. Qui suscipit veniam excepturi
                                 quod.</em></p>
                         <p>
                             {{ $siteSetting->address ?? '' }} <br>
                             <br><br>
                             <strong>Phone:</strong> {{ $siteSetting->mobile1 ?? '' }}<br>
                             <strong>Email:</strong> {{ $siteSetting->contact_email ?? '' }}<br>
                         </p>
                         <div class="social-links mt-3">
                             <a href="{{ $siteSetting->tw ?? '' }}" class="twitter"><i class="bx bxl-twitter"></i></a>
                             <a href="{{ $siteSetting->fb ?? '' }}" class="facebook"><i class="bx bxl-facebook"></i></a>
                             <a href="{{ $siteSetting->yt ?? '' }}" class="instagram"><i class="bx bxl-youtube"></i></a>
                             <a href="{{ $siteSetting->ln ?? '' }}" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                         </div>
                     </div>
                 </div>

                 <div class="col-lg-2 col-md-6 footer-links">
                     <h4>Useful Links</h4>
                     <ul>
                         {!! WebsiteMenus::footerMenu($footerMenu) !!}
                     </ul>
                 </div>
             </div>
         </div>
     </div>

     <div class="container">
         <div class="copyright">
             &copy; Copyright <strong><span>Nogor Solutions LTD</span></strong>. All Rights Reserved
         </div>
         <div class="credits">
             Developed by <a href="https://www.nogorsolutions.com">Nogor Solutions LTD</a>
         </div>
     </div>
 </footer><!-- End Footer -->

 <div id="preloader"></div>
 <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
         class="bi bi-arrow-up-short"></i></a>
