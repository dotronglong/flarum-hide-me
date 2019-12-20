import {extend} from 'flarum/extend';
import app from 'flarum/app';
import PermissionGrid from 'flarum/components/PermissionGrid';
import HideMeSettingsModal from "./components/HideMeSettingsModal";

app.initializers.add('dotronglong-hide-me', () => {
    extend(PermissionGrid.prototype, 'moderateItems', items => {
        items.add('dotronglong-hide-me', {
            icon: 'fas fa-user-shield',
            label: app.translator.trans('dotronglong-hide-me.admin.permissions.see_author'),
            permission: 'dotronglong-hide-me.seeAuthor'
        });
    });

    app.extensionSettings['dotronglong-hide-me'] = () => app.modal.show(new HideMeSettingsModal());
});
