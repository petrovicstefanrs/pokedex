
///////////////////////////////// MOVE ELEMENTS ON MOUSE MOVE /////////////////////////////////

// Setting up variables

var lFollowX = 0,
    lFollowY = 0,
    x = 0,
    y = 0,
    x1 = 0,
    y1 = 0,
    friction = 1 / 25;

// Function for moving the background on HERO-HEADER

function moveBackground() {
  x += (lFollowX - x) * friction;
  y += (lFollowY - y) * friction;
  
  translate = 'translate(' + x + 'px, ' + y + 'px) scale(1.3)';
  translate1 = 'translate(' + x + 'px, ' + y + 'px) scale(1.0)';

  $('.bg').css({
    '-webit-transform': translate,
    '-moz-transform': translate,
    'transform': translate
  });

  $('.info__content').css({
    '-webit-transform': translate1,
    '-moz-transform': translate1,
    'transform': translate1
  });

  window.requestAnimationFrame(moveBackground);
}

// Function for moving the logo on HERO-HEADER

function moveLogo() {
  x1 += (lFollowX - x1) * friction;
  y1 += (lFollowY - y1) * friction;
  
  translate = 'translate(' + -x1 + 'px, ' + y1 + 'px) scale(1.0)';

  $('.plogo').css({
    '-webit-transform': translate,
    '-moz-transform': translate,
    'transform': translate
  });

  window.requestAnimationFrame(moveLogo);
}

// Function for moving images in INFO SECTIONS

function movePoke() {
  x1 += (lFollowX - x1) * friction;
  y1 += (lFollowY - y1) * friction;
  
  translate = 'translate(' + -x1 + 'px, ' + y1 + 'px) scale(1.0)';

  $('.pokemon__img').css({
    '-webit-transform': translate,
    '-moz-transform': translate,
    'transform': translate
  });

  window.requestAnimationFrame(movePoke);
}

// Function for moving the logo on HERO-HEADER

function moveLogin() {
  x1 += (lFollowX - x1) * friction;
  y1 += (lFollowY - y1) * friction;
  
  translate = 'translate(' + -(50+((x1*2)*100/$(window).width())) + '%, ' + -(50+((y1*2)*100/$(window).height())) + '%) scale(0.6, 0.6)';

  $('.materialContainer').css({
    '-webit-transform': translate,
    '-moz-transform': translate,
    'transform': translate
  });

  window.requestAnimationFrame(moveLogin);
}

// Function for moving the img on AboutMe Page

function moveAboutmeImg() {
  x1 += (lFollowX - x1) * friction;
  y1 += (lFollowY - y1) * friction;
  
  translate = 'translate(' + x1/4 + 'px, ' + y1/4 + 'px) skew(15deg, 0deg)';

  $('.aboutme_right_img img').css({
    '-webit-transform': translate,
    '-moz-transform': translate,
    'transform': translate
  });

  window.requestAnimationFrame(moveAboutmeImg);
}

// Function for moving text on AboutMe Page

function moveAboutmeText() {
  x1 += (lFollowX - x1) * friction;
  y1 += (lFollowY - y1) * friction;
  
  translate = 'translate(' + -x1/4 + 'px, ' + y1/4 + 'px) scale(1.0)';

  $('.author_info').css({
    '-webit-transform': translate,
    '-moz-transform': translate,
    'transform': translate
  });

  window.requestAnimationFrame(moveAboutmeText);
}

// Function for moving poke img on bigcard

function moveBigcardImg() {
  x1 += (lFollowX - x1) * friction;
  y1 += (lFollowY - y1) * friction;
  
  translate = 'translate(' + x1/3 + 'px, ' + y1 + 'px) skew(15deg, 0deg)';

  $('.bigcard_right_img img').css({
    '-webit-transform': translate,
    '-moz-transform': translate,
    'transform': translate
  });

  window.requestAnimationFrame(moveBigcardImg);
}
// This handles value changes for lFollowX and lFollowY depending on Mouse Position

$(window).on('mousemove click', function(e) {

  var lMouseX = Math.max(-100, Math.min(100, $(window).width() / 2 - e.clientX));
  var lMouseY = Math.max(-100, Math.min(100, $(window).height() / 2 - e.clientY));
  lFollowX = (20 * lMouseX) / 100; // 100 : 12 = lMouxeX : lFollow
  lFollowY = (10 * lMouseY) / 100;

});

// Finaly run all functions

moveBackground();
moveLogo();
movePoke();
moveLogin();
moveAboutmeImg();
moveAboutmeText();
moveBigcardImg();

