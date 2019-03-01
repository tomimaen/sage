import objectFitImages from 'object-fit-images';
import LazyLoad from 'vanilla-lazyload/dist/lazyload';

export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired

    objectFitImages();
    new LazyLoad({
      elements_selector: '.lazy',
    });
  },
};
