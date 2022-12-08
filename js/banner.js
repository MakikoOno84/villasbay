/**
 * File banner.js.
 *
 * Handles displaying title after playing a video 
 * 
 */
"use strict";
const bannerVideo = document.getElementById('welcome-video');
const heroText= document.getElementById('hero-text');

if (bannerVideo) {
    bannerVideo.addEventListener('ended',(event) => {
    // console.log('video ended!');
    heroText.classList.add("active");
})
}

