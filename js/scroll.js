/**
 * File scroll.js.
 *
 * Handle the background color of header as scroll up-down 
 * 
 */
 "use strict";

 const customeHeader = document.getElementById('custom-page-header');
//  const bannerOverlay = document.getElementById('banner-overlay');
const banner = document.getElementById('entry-header');

if (banner && customeHeader) {
window.addEventListener('DOMContentLoaded', function(){

    window.addEventListener('scroll', function(){
        const bannerHeight = banner.offsetHeight;
        // console.log("Vertical Scroll:" + window.scrollY + " Banner Height:" + bannerHeight );
        if (bannerHeight < window.scrollY + 120) {
            customeHeader.classList.add("scrollDown");
        } else {
            customeHeader.classList.remove("scrollDown");
        }
    });

});

}
