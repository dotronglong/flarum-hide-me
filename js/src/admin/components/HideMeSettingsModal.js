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
        <label>
            <Switch className="FormControl" bidi={this.setting('dotronglong-hide-me.enable_ghost_mode')}/>
            {app.translator.trans('dotronglong-hide-me.admin.settings.enable_ghost_mode_label')}
        </label>
      </div>
    ];
  }
}
