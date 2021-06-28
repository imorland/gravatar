import app from 'flarum/admin/app';
import defaultOptions from '../common/utils/defaultOptions';
import ratingOptions from '../common/utils/ratingOptions';

app.initializers.add('ianm/gravatar', () => {
    app.extensionData
        .for('ianm-gravatar')
        .registerSetting(function () {
            return [
                <div class="helpText">{app.translator.trans('ianm-gravatar.admin.settings.proxy.helptext')}</div>
            ]
        })
        .registerSetting({
            label: app.translator.trans('ianm-gravatar.admin.settings.proxy.title'),
            setting: 'ianm-gravatar.proxy',
            type: 'bool',
        })
        .registerSetting(function () {
            return [<div class="helpText">{app.translator.trans('ianm-gravatar.admin.settings.replace-flarum-custom.helptext')}</div>];
        })
        .registerSetting({
            label: app.translator.trans('ianm-gravatar.admin.settings.replace-flarum-custom.title'),
            setting: 'ianm-gravatar.replace-flarum-custom',
            type: 'bool',
        })
        .registerSetting(function () {
            return [
                <h3>{app.translator.trans('ianm-gravatar.admin.settings.defaults.title')}</h3>,
                <div class="helpText">{app.translator.trans('ianm-gravatar.admin.settings.defaults.helptext')}</div>,
            ];
        })
        .registerSetting({
            setting: 'ianm-gravatar.default',
            type: 'select',
            options: defaultOptions(),
        })
        .registerSetting(function () {
            return [<div class="helpText">{app.translator.trans('ianm-gravatar.admin.settings.force-default.helptext')}</div>];
        })
        .registerSetting({
            label: app.translator.trans('ianm-gravatar.admin.settings.force-default.title'),
            setting: 'ianm-gravatar.force-default',
            type: 'bool',
        })
        .registerSetting(function () {
            return [
                <h3>{app.translator.trans('ianm-gravatar.admin.settings.rating.title')}</h3>,
                <div class="helpText">{app.translator.trans('ianm-gravatar.admin.settings.rating.helptext')}</div>,
            ];
        })
        .registerSetting({
            setting: 'ianm-gravatar.rating',
            type: 'select',
            options: ratingOptions(),
        });
});
