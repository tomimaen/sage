import FontFaceObserver from 'fontfaceobserver';

const fonts = ['Source Sans Pro'];
const loadedClass = 'fonts-loaded';

function loadWebFonts () {
  if ( sessionStorage.fontsLoaded ) {
    document.documentElement.classList.add(loadedClass);
    return;
  }

  Promise.all(fonts.map(font => new FontFaceObserver(font).load()))
    .then(
        () => {
            document.documentElement.classList.add(loadedClass);
            sessionStorage.fontsLoaded = true;
        },
        () => {}
    );
}

export default loadWebFonts;
