/* eslint-disable */

const cssnanoConfig = {
  preset: ['default', { discardComments: { removeAll: true } }]
};

module.exports = ({ file, options }) => {
  return {
    parser: options.enabled.optimize ? 'postcss-safe-parser' : undefined,
    plugins: {
      autoprefixer: true,
      'postcss-object-fit-images': true,
      'postcss-inline-svg': true,
      cssnano: options.enabled.optimize ? cssnanoConfig : false,
    },
  };
};
