import Extend from 'flarum/common/extenders';
import app from 'flarum/admin/app';
import defaultOptions from '../common/utils/defaultOptions';
import ratingOptions from '../common/utils/ratingOptions';

export default [
  new Extend.Admin()
    .setting(() => ({
      label: app.translator.trans('ianm-gravatar.admin.settings.proxy.title'),
      setting: 'ianm-gravatar.proxy',
      type: 'bool',
      help: app.translator.trans('ianm-gravatar.admin.settings.proxy.helptext'),
    }))
    .setting(() => ({
      label: app.translator.trans('ianm-gravatar.admin.settings.replace-flarum-custom.title'),
      setting: 'ianm-gravatar.replace-flarum-custom',
      type: 'bool',
      help: app.translator.trans('ianm-gravatar.admin.settings.replace-flarum-custom.helptext'),
    }))
    .setting(() => ({
      label: app.translator.trans('ianm-gravatar.admin.settings.defaults.title'),
      setting: 'ianm-gravatar.default',
      type: 'select',
      options: defaultOptions(),
      help: app.translator.trans('ianm-gravatar.admin.settings.defaults.helptext'),
    }))
    .setting(() => ({
      label: app.translator.trans('ianm-gravatar.admin.settings.force-default.title'),
      setting: 'ianm-gravatar.force-default',
      type: 'bool',
      help: app.translator.trans('ianm-gravatar.admin.settings.force-default.helptext'),
    }))
    .setting(() => ({
      label: app.translator.trans('ianm-gravatar.admin.settings.rating.title'),
      setting: 'ianm-gravatar.rating',
      type: 'select',
      options: ratingOptions(),
      help: app.translator.trans('ianm-gravatar.admin.settings.rating.helptext'),
    })),
];
