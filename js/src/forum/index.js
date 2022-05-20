import app from 'flarum/forum/app';
import Model from 'flarum/common/Model';
import { extend } from 'flarum/common/extend';
import AvatarEditor from 'flarum/forum/components/AvatarEditor';

app.initializers.add('ianm/gravatar', () => {
  app.store.models.users.prototype.gravatar = Model.attribute('gravatar');

  extend(AvatarEditor.prototype, 'controlItems', function (items) {
    const user = this.attrs.user;
    items.remove('upload');

    if (user.gravatar()) {
      items.remove('remove');

      items.add(
        'gravatar',
        <a href="https://gravatar.com" target="_blank" class="hasIcon">
          <i class="icon fas fa-edit Button-icon"></i>
          <span class="Button-label">{app.translator.trans('ianm-gravatar.forum.settings.edit-gravatar')}</span>
        </a>
      );
    }
  });
});
