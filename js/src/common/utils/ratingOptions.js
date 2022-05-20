import app from 'flarum/common/app';

let opts;

export default () =>
  opts ||
  (opts = ['g', 'pg', 'r', 'x'].reduce((o, key) => {
    o[key] = app.translator.trans(`ianm-gravatar.admin.settings.rating.${key}_label`);

    return o;
  }, {}));
