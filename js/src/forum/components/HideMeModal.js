import Button from 'flarum/components/Button';
import Modal from 'flarum/components/Modal';
import Checkbox from 'flarum/components/Checkbox';

export default class HideMeModal extends Modal {
    init() {
        super.init();
        this.privacy = this.props.privacy;
    }

    title() {
        return app.translator.trans('dotronglong-hide-me.forum.modal.title');
    }

    className() {
        return 'HideMeDiscussionModal Modal--small';
    }

    content() {
        const isPublic = this.privacy === 1;
        const isAnonymous = this.privacy === 2;
        const isGhost = this.privacy === 3;
        const items = [
            <li className="item-nav">
                <Checkbox state={isPublic} onchange={() => this.privacy=1}><strong>{app.translator.trans('dotronglong-hide-me.forum.modal.privacy_public_label')}</strong></Checkbox>
                <small>{app.translator.trans('dotronglong-hide-me.forum.modal.privacy_public_info')}</small>
            </li>,
            <li className="item-nav">
                <Checkbox state={isAnonymous} onchange={() => this.privacy=2}><strong>{app.translator.trans('dotronglong-hide-me.forum.modal.privacy_anonymous_label')}</strong></Checkbox>
                <small>{app.translator.trans('dotronglong-hide-me.forum.modal.privacy_anonymous_info')}</small>
            </li>
        ];
        if (app.forum.data.attributes.enableGhostMode === true) {
            items.push(
                <li className="item-nav">
                    <Checkbox state={isGhost} onchange={() => this.privacy=3}><strong>{app.translator.trans('dotronglong-hide-me.forum.modal.privacy_ghost_label')}</strong></Checkbox>
                    <small>{app.translator.trans('dotronglong-hide-me.forum.modal.privacy_ghost_info')}</small>
                </li>
            );
        }
        return [
            <div className="Modal-body">
                <div className="HideMeDiscussionModal-form">
                    <div className="Form-group">
                        <label>{app.translator.trans('dotronglong-hide-me.forum.modal.privacy_label')}</label>
                        <ul>
                            {items}
                        </ul>
                    </div>

                    <div className="Form-group">
                        {Button.component({
                            type: 'submit',
                            className: 'Button Button--primary PostPrivacyModal-SubmitButton',
                            children: app.translator.trans('dotronglong-hide-me.forum.modal.submit'),
                            loading: this.loading,
                        })}
                    </div>
                </div>
            </div>,
        ];
    }

    onsubmit(e) {
        e.preventDefault();
        this.props.onsubmit(this.privacy);
        app.modal.close();
    }
}
