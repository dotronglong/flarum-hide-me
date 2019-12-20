import {extend} from 'flarum/extend';
import app from 'flarum/app';

import addDiscussionComposerItem from './addDiscussionComposerItem';

app.initializers.add('dotronglong-hide-me', () => {
    addDiscussionComposerItem();
});
