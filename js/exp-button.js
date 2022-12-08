"use strict";

var elements = document.getElementsByClassName('exp');

function toggleExp(){
    for(var i = 0; i < elements.length; i++) {
        elements[i].style.display = "block";
    }
};


function toggleDining(){
    for(var i = 0; i < elements.length; i++) {
        elements[i].style.display = "none";
    }
    var dining = document.getElementsByClassName('Dining');
    for(var i = 0; i < dining.length; i++) {
        dining[i].style.display = "block";
    }  
};

function toggleExplore(){
    for(var i = 0; i < elements.length; i++) {
        elements[i].style.display = "none";
    }
    var explore = document.getElementsByClassName('Explore');
    for(var i = 0; i < explore.length; i++) {
        explore[i].style.display = "block";
    }  
};

function toggleWellness(){
    for(var i = 0; i < elements.length; i++) {
        elements[i].style.display = "none";
    }
    var wellness = document.getElementsByClassName('Wellness');
    for(var i = 0; i < wellness.length; i++) {
        wellness[i].style.display = "block";
    }  
};
