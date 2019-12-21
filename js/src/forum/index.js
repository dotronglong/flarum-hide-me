import app from 'flarum/app';

import addComposerItem from './addComposerItem';

app.initializers.add('dotronglong-hide-me', () => {
    addComposerItem();
});
