import app from 'flarum/common/app';

let opts;

export default () =>
  opts ||
  (opts = ['mp', 'identicon', 'monsterid', 'wavatar', 'retro', 'robohash'].reduce((o, key) => {
    o[key] = app.translator.trans(`ianm-gravatar.admin.settings.defaults.${key}_label`);

    return o;
  }, {}));
