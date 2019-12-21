import {extend} from 'flarum/extend';
import Composer from 'flarum/components/Composer';
import DiscussionComposer from 'flarum/components/DiscussionComposer';
import EditPostComposer from 'flarum/components/EditPostComposer';
import ReplyComposer from 'flarum/components/ReplyComposer';
import ComposerButton from 'flarum/components/ComposerButton';

import HideMeModal from './components/HideMeModal';

export default () => {

    Composer.prototype.hideMe = function () {
        app.modal.show(
            new HideMeModal({
                privacy: app.composer.props.hide_me === undefined ? 1 : app.composer.props.hide_me,
                onsubmit: mode => (app.composer.props.hide_me = mode),
            })
        );
    };

    extend(Composer.prototype, 'controlItems', function (items) {
        let buttonClassname = "Button Button--icon Button--link ";
        let buttonTitle = "";
        const mode = app.composer.props.hide_me;
        if (mode === undefined || mode === 1) {
            buttonClassname += "privacy-text-public";
            buttonTitle = app.translator.trans('dotronglong-post-privacy.forum.modal.privacy_public_label');
        } else if (mode === 2) {
            buttonClassname += "privacy-text-anonymous";
            buttonTitle = app.translator.trans('dotronglong-post-privacy.forum.modal.privacy_anonymous_label');
        }
        items.add('privacy', ComposerButton.component({
            icon: 'fas fa-user-shield minimize',
            className: buttonClassname,
            title: buttonTitle,
            onclick: this.hideMe
        }), 1);
    });

    extend(DiscussionComposer.prototype, 'data', function (data) {
        if (app.composer.props.hide_me) {
            data.hide_me = app.composer.props.hide_me;
        }
    });

    extend(EditPostComposer.prototype, 'data', function (data) {
        if (app.composer.props.hide_me) {
            data.hide_me = app.composer.props.hide_me;
        }
    });

    extend(ReplyComposer.prototype, 'data', function (data) {
        if (app.composer.props.hide_me) {
            data.hide_me = app.composer.props.hide_me;
        }
    });
};
