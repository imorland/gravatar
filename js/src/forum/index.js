import app from 'flarum/forum/app';
import { extend, override } from 'flarum/common/extend';
import AvatarEditor from 'flarum/forum/components/AvatarEditor';
import Icon from 'flarum/common/components/Icon';

export { default as extend } from './extend';

app.initializers.add('ianm/gravatar', () => {
  // Without an uploaded avatar, AvatarEditor opens the file picker (on click)
  // or uploads straight away (on drop) instead of showing its menu. Uploads
  // are disabled, so always fall through to the menu.
  override(AvatarEditor.prototype, 'quickUpload', function () {});
  override(AvatarEditor.prototype, 'upload', function () {});
  override(AvatarEditor.prototype, 'enableDragover', function () {});

  // A gravatar is an avatar, so show the edit icon rather than the "add avatar" one.
  extend(AvatarEditor.prototype, 'view', function (vdom) {
    if (this.loading || !this.attrs.user.gravatar()) return;

    const toggle = vdom.children.find((child) => child?.tag === 'button');

    if (!toggle) return;

    toggle.attrs.className = 'Dropdown-toggle';
    toggle.children = [<Icon name="fas fa-pencil-alt" />];
  });

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
