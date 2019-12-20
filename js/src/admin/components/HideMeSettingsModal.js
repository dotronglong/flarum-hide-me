import Switch from 'flarum/components/Switch';
import SettingsModal from 'flarum/components/SettingsModal';

export default class HideMeSettingsModal extends SettingsModal {
    className() {
        return 'HideMeSettingsModal Modal--small';
    }

    title() {
        return app.translator.trans('dotronglong-hide-me.admin.settings.title');
    }

    form() {
        return [
            <div className="Form-group">
                <Switch state={this.setting('dotronglong-hide-me.enable_ghost_mode')()}
                        onchange={() => this.change.bind(this)('dotronglong-hide-me.enable_ghost_mode')}/>
                <label>{app.translator.trans('dotronglong-hide-me.admin.settings.enable_ghost_mode_label')}</label>
            </div>
        ];
    }

    change(key) {
        const v = this.setting('dotronglong-hide-me.enable_ghost_mode')();
        this.settings[key] = () => !v;
    }
}
