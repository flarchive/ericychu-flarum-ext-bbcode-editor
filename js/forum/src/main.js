import {extend} from 'flarum/extend';
import app from 'flarum/app';
import ComposerBody from 'flarum/components/ComposerBody';
import BBCodeEditor from 'flarum/bbcode-editor/components/BBCodeEditor';

app.initializers.add('xengine-mdeditor', () => {
    extend(ComposerBody.prototype, 'init', function init() {
        this.editor = new BBCodeEditor({
            submitLabel: this.props.submitLabel,
            placeholder: this.props.placeholder,
            onchange: this.content,
            onsubmit: this.onsubmit.bind(this),
            value: this.content()
        })
    });
});
