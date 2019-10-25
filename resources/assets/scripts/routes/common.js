import ObjectFitImages from 'object-fit-images';
import LazyLoad from 'vanilla-lazyload/dist/lazyload';
import WebFontLoader from '../components/WebFontLoader';

export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired

    new LazyLoad({
      elements_selector: '.lazy',
    });

    ObjectFitImages();
    WebFontLoader();
  },
};
