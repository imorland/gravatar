import app from 'flarum/admin/app';
import defaultOptions from '../common/utils/defaultOptions';
import ratingOptions from '../common/utils/ratingOptions';

app.initializers.add('ianm/gravatar', () => {
    app.extensionData
        .for('ianm-gravatar')
        .registerSetting({
            label: app.translator.trans('ianm-gravatar.admin.settings.proxy.title'),
            setting: 'ianm-gravatar.proxy',
            type: 'bool',
            help: app.translator.trans('ianm-gravatar.admin.settings.proxy.helptext'),
        })
        .registerSetting({
            label: app.translator.trans('ianm-gravatar.admin.settings.replace-flarum-custom.title'),
            setting: 'ianm-gravatar.replace-flarum-custom',
            type: 'bool',
            help: app.translator.trans('ianm-gravatar.admin.settings.replace-flarum-custom.helptext'),
        })
        .registerSetting({
            label: app.translator.trans('ianm-gravatar.admin.settings.defaults.title'),
            setting: 'ianm-gravatar.default',
            type: 'select',
            options: defaultOptions(),
            help: app.translator.trans('ianm-gravatar.admin.settings.defaults.helptext'),
        })
        .registerSetting({
            label: app.translator.trans('ianm-gravatar.admin.settings.force-default.title'),
            setting: 'ianm-gravatar.force-default',
            type: 'bool',
            help: app.translator.trans('ianm-gravatar.admin.settings.force-default.helptext'),
        })
        .registerSetting({
            label: app.translator.trans('ianm-gravatar.admin.settings.rating.title'),
            setting: 'ianm-gravatar.rating',
            type: 'select',
            options: ratingOptions(),
            help: app.translator.trans('ianm-gravatar.admin.settings.rating.helptext'),
        });
});
